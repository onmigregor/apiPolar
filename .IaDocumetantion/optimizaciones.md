# Optimizaciones del Proyecto POLAR Productos API

> Documento generado: 2026-03-09  
> Sesión de optimización sobre el módulo de carga masiva de productos y arquitectura general.

---

## ✅ Aplicadas

### 1. Trait `HasMapperTransform` — Centralización de Mappers
- **Archivo:** `app/Traits/HasMapperTransform.php`
- **Qué hace:** Centraliza el método `transform()` que convierte llaves camelCase/UPPER a snake_case.
- **Aplicado a:** 29 Mappers del proyecto.
- **Impacto:** ~580 líneas de código duplicado eliminadas.
- **Antes:** Cada Mapper tenía su propio `transform()` idéntico.
- **Después:** Solo definen `$map` y usan `use HasMapperTransform;`.

### 2. Trait `HasMapperRequest` — Centralización de FormRequests
- **Archivo:** `app/Traits/HasMapperRequest.php`
- **Qué hace:** Centraliza `prepareForValidation()` que invoca `Mapper::transform()`.
- **Aplicado a:** 29 FormRequests del proyecto.
- **Impacto:** ~145 líneas de código duplicado eliminadas.
- **Antes:** Cada Request tenía su propio `prepareForValidation()` idéntico.
- **Después:** Solo definen `$mapperClass` y `rules()`, y usan `use HasMapperRequest;`.

### 3. Deduplicación antes de `upsert()`
- **Archivo:** `modules/Product/Actions/MasterProductAction.php`
- **Qué hace:** Elimina registros duplicados del JSON en memoria antes de enviarlos a MySQL.
- **Impacto:** Reduce filas procesadas por BD (ej: de 3,942 a ~3,554 en `productUnit`).

### 4. Logging de registros filtrados
- **Archivo:** `modules/Product/Actions/MasterProductAction.php`
- **Qué hace:** Registra con `Log::warning()` cada registro omitido por clave inválida.
- **Dónde ver:** `storage/logs/laravel.log`

### 5. Respuesta API enriquecida
- **Archivo:** `modules/Product/Http/Controllers/ProductController.php`
- **Qué hace:** El endpoint `masterProduct` ahora retorna `summary` (totales globales) + `detail` (por sección con `processed`, `skipped`, `duplicates_removed`).

### 6. Validación de encoding
- **Archivo:** `modules/Product/Http/Controllers/ProductController.php`
- **Qué hace:** Detecta si el payload viene en ISO-8859-1 y lo convierte a UTF-8 automáticamente.

### 7. Cache estático de `$fillable`
- **Archivo:** `modules/Product/Actions/MasterProductAction.php`
- **Qué hace:** Evita re-instanciar modelos para obtener `$fillable` en cada iteración.

### 8. `now()` calculado una sola vez por lote
- **Archivo:** `modules/Product/Actions/MasterProductAction.php`
- **Qué hace:** Un solo `$now = now();` para todo el lote, en lugar de calcularlo por cada fila.

### 9. Endpoint Truncate Products
- **Archivo:** `modules/Product/Actions/TruncateProductAction.php`
- **Ruta:** `DELETE /api/truncate-products`
- **Qué hace:** Vacía las 5 tablas de productos en orden inverso de dependencias con FK checks desactivados.

### 10. Corrección de restricciones de nulidad
- **Archivos:** Migraciones de `products` y `product_units`
- **Qué hace:** Campos como `pro_short_name`, `pru_divide_by` ahora son `nullable()` para aceptar datos vacíos de Polar.

### 11. Regenerar Swagger
- **Comando:** `docker exec polar-productos_api php artisan l5-swagger:generate`
- **Qué hace:** Actualiza la documentación de la API con el nuevo endpoint `truncate-products`.

---

## ⏳ Pendientes

### 1. Índices únicos en migraciones
- Agregar `$table->unique('pro_code')` en `products`.
- Agregar `$table->unique(['pro_code', 'unt_code'])` en `product_units`.
- **Por qué:** El `upsert()` de Laravel necesita estos índices para funcionar como `INSERT ON DUPLICATE KEY UPDATE`. Sin ellos, MySQL inserta duplicados.

### 2. Relaciones Eloquent (FK reales)
- `Product` → `belongsTo(ProductCategory)`, `belongsTo(Unit)`
- `ProductUnit` → `belongsTo(Product)`, `belongsTo(Unit)`
- `ProductCategory` → `belongsTo(ProductFamily)`
- **Por qué:** Permite usar eager loading, evitar N+1 queries, y tener integridad referencial.

### 3. Centralizar `authorize()` en los FormRequests
- Mover `authorize() { return true; }` al trait `HasMapperRequest`.
- **Impacto:** Eliminar la función de los 29 FormRequests (~87 líneas más).

### 4. Controladores CRUD base
- Explorar un trait o clase base `BaseCrudController` para los controllers que siguen el patrón estándar `index/store/show/update/destroy`.
- **Por qué:** Reducir boilerplate en los ~29 controllers.

### 5. DTOs similares
- Los `fromRequest()` de los DTOs probablemente siguen un patrón repetitivo que se puede centralizar.

### 6. Limpieza de archivos temporales
- Eliminar `verify_bulk.php` y `test_json.php` de la raíz del proyecto.


---

## Arquitectura de Traits Centralizada

```
app/Traits/
├── ApiResponse.php          ← Respuestas HTTP homologadas ($this->success / $this->error)
├── HasMapperTransform.php   ← transform() para todos los Mappers
└── HasMapperRequest.php     ← prepareForValidation() para todos los FormRequests
```

### Flujo completo con traits:

```
Request HTTP
  ↓
FormRequest (usa HasMapperRequest)
  → llama Mapper::transform() (usa HasMapperTransform)  
  → valida con rules()
  ↓
Controller (usa ApiResponse)
  → delega al Action
  ↓
Action (lógica de negocio)
  → retorna al Controller
  ↓
Resource (formateo JSON)
  → Controller retorna $this->success()
```
