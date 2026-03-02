---
trigger: always_on
---

# Reglas de Arquitectura del Proyecto (DDD y SOLID)

Para mantener la coherencia y escalabilidad del proyecto, todo desarrollo DEBE regirse por las siguientes directrices basadas en Domain-Driven Design (DDD) y principios SOLID. **Toda la lógica debe vivir estructurada dentro del directorio del módulo correspondiente.**

## 1. Creación de Módulos (Obligatorio)
Para crear un nuevo módulo se **DEBE usar exclusivamente el comando automatizado** de Artisan. Esto garantiza que se cree toda la estructura (Actions, DTOs, Controllers, Requests, Models) de forma estandarizada.
```bash
php artisan module:create NombreDelModulo
```

## 2. Flujo CRUD Funcional (Reglas DDD/SOLID)
El desarrollo de cualquier CRUD o lógica de negocio debe respetar esta estricta separación de responsabilidades dentro de su propio módulo:

### A. Controladores (Controllers)
- **El Controlador solo DELEGA.**
- No debe contener lógica de negocio, validaciones nativas, ni consultas directas a la base de datos (Eloquent).
- Su única función es recibir el flujo, pasarlo al Action, y retornar la respuesta utilizando el Response homologado.
- Debe usar el trait `App\Traits\ApiResponse` para entregar siempre `$this->success()` o `$this->error()`.

### B. Validación (Requests)
- Toda validación de entrada de datos se delega exclusivamente a una clase `FormRequest` ubicada en `modules/{Modulo}/Http/Requests/`.

### C. Transferencia de Datos (DTOs)
- Los datos validados por el Request se encapsulan en un **Data Transfer Object (DTO)** (`modules/{Modulo}/DataTransferObjects/`).
- Estos objetos fuertemente tipados son los únicos que viajan desde el Controlador hacia el Action.

### D. Lógica de Negocio (Actions)
- **Los Actions EJECUTAN la lógica.**
- Todo el código que interactúa con el modelo, guarda, actualiza, elimina o procesa datos, vive en una clase Action con **Responsabilidad Única**.
- Están ubicados en `modules/{Modulo}/Actions/` (ej. `RouteStoreAction`, `RouteListAction`).
- Reciben el DTO, operan la Base de Datos, y retornan el modelo puro.

### E. Formateo de Respuesta (Resources)
- La respuesta que se enviará al cliente HTTP jamás debe ser el Modelo de base de datos directo, sino que debe pasar por un `JsonResource` ubicado en `modules/{Modulo}/Http/Resources/`.
- Esto envuelve y piratea los datos al cliente protegiendo la estructura interna.


### F. Mapper (Homologación de Campos)
- Para **todo módulo** se DEBE crear una clase Mapper ubicada en `modules/{Modulo}/Mappers/{Modulo}Mapper.php`.
- El Mapper define un mapa estático (`$map`) que traduce los nombres de campos que llegan del cliente (generalmente en **camelCase** o **MAYÚSCULAS**) a los nombres en **snake_case** que usa la base de datos.
- La base de datos SIEMPRE usa convención `snake_case` (ej. `tp1_code`, `tp1_name`).
- El Mapper se invoca dentro del método `prepareForValidation()` del `FormRequest`, de forma que la transformación de llaves ocurre **ANTES** de que se ejecuten las reglas de validación.
- Esto garantiza que las reglas del Request validen sobre los campos ya mapeados en snake_case.

**Ejemplo de Mapper:**
```php
class CustomerGroupMapper
{
    // snake_case (BD) => [posibles llaves de entrada]
    public static array $map = [
        'tp1_code' => ['tp1Code'],
        'tp1_name' => ['tp1Name'],
    ];

    public static function transform(array $data): array
    {
        $mapped = [];
        foreach ($data as $key => $value) {
            $resolved = $key;
            foreach (self::$map as $target => $aliases) {
                if (in_array($key, $aliases, true)) {
                    $resolved = $target;
                    break;
                }
            }
            $mapped[$resolved] = $value;
        }
        return $mapped;
    }
}
```

**Uso en el FormRequest:**
```php
protected function prepareForValidation(): void
{
    $this->merge(
        CustomerGroupMapper::transform($this->all())
    );
}
```

---
**Resumen del Flujo Intocable:**
`Ruta` -> `Controller` -> `Request.prepareForValidation() [Mapper]` -> `Request.rules() [Validación]` -> `DTO (Empaquetado)` -> `Action (Lógica de Negocio)` -> `Resource (Formateo)` -> `Controller (Retorna ApiResponse)`
