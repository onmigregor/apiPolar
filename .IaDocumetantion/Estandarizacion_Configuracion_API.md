# Plan de Blindaje: Configuración de API Centralizada

Este plan resuelve el problema de "Unauthenticated" causado por el uso de `env()` en las Acciones cuando la configuración de Laravel está cacheada. Se estandarizarán los 7 módulos del proyecto `productosPolarApi`.

## 1. Fase 1: Creación del Archivo de Configuración
Crearemos un archivo central donde Laravel registrará las credenciales de la API de forma segura y compatible con la caché.

#### [NEW] `config/polar.php`
```php
<?php

return [
    'api_url'   => env('POLAR_API_URL', 'http://polar_api/api'),
    'api_token' => env('POLAR_API_TOKEN'),
];
```

## 2. Fase 2: Refactorización de Módulos
Sustituiremos todas las llamadas directas a `env()` por la función `config()`, la cual es segura y funciona siempre, incluso con caché activada.

### Módulos a Intervenir:

#### Master Productos, Clientes, Promotion y Empresas
*   `modules/MasterProduct/Actions/...`
*   `modules/MasterClient/Actions/...`
*   `modules/MasterPromotion/Actions/...`
*   `modules/Company/Actions/...` (Empresas)

#### Cargas Manuales (ADC, Planes, Precios)
*   `modules/CustomerADC/Actions/SyncCustomerAdcToPolarApiAction.php`
*   `modules/DynamicPlan/Actions/SyncDynamicPlansToTenantsAction.php`
*   `modules/ProductsPrice/Actions/SyncProductsPriceToPolarApiAction.php`

## 3. Beneficios
1.  **Inmunidad a la Caché**: Podrás correr `php artisan config:cache` para mejorar la velocidad sin romper las sincronizaciones.
2.  **Punto Único de Control**: Si mañana cambia la estructura de la API, solo se edita un archivo (`config/polar.php`).
3.  **Código Limpio**: Eliminamos la redundancia de definir URLs por defecto en cada acción.

---

## Verification Plan
1. Ejecutar `php artisan config:cache` (Esto antes rompía el sistema).
2. Intentar una sincronización de cualquiera de los 7 módulos.
3. Confirmar que la respuesta sea exitosa y el token se lea correctamente.
