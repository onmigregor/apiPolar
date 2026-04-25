# Plan de Optimización de Rendimiento (Admin)

Este plan aborda las vulnerabilidades de rendimiento (memoria y base de datos) presentes en los tres módulos de carga masiva del proyecto `productosPolarApi` (Admin): **CustomerADC**, **DynamicPlan** y **ProductsPrice**.

## 1. Fase 1: Optimización de Importación Excel (Cuello de botella DB)

### Problema Actual
Las clases de importación (`CustomerAdcImport`, `PlanesDinamicosImport`, `ProductsPriceImport`) utilizan el método `updateOrCreate` dentro de un bucle `foreach`. Esto significa que por cada fila del Excel, Laravel hace 2 consultas a la base de datos (un `SELECT` y un `INSERT/UPDATE`). Un archivo de 10,000 líneas generará **20,000 consultas**, bloqueando la base de datos y tardando minutos en procesar.

### Solución Propuesta
Cambiar la lógica para usar **Upsert por lotes (Chunks)**. 
1. Leer las filas del Excel y guardarlas en un array en memoria.
2. Cada 500 registros, ejecutar un único comando `upsert()`.
3. Esto reduce 20,000 consultas a solo **20 consultas**, bajando el tiempo de procesamiento a un par de segundos.

### Archivos a Modificar
*   `modules/CustomerADC/Imports/CustomerAdcImport.php`
*   `modules/DynamicPlan/Imports/PlanesDinamicosImport.php`
*   `modules/ProductsPrice/Imports/ProductsPriceImport.php`

---

## 2. Fase 2: Optimización de Sincronización API (Cuello de botella RAM)

### Problema Actual
Las acciones de sincronización (ej. `SyncDynamicPlansToTenantsAction`, `SyncCustomerAdcToPolarApiAction`) utilizan `Model::all()->toArray()` para cargar **toda la tabla** en la memoria RAM del servidor y enviarla en un único `POST` gigante a PolarAPI. Si la tabla crece a 50,000 registros, el servidor arrojará un error de *Out of Memory* o la API rechazará el payload por ser muy pesado.

### Solución Propuesta (Envío por Chunks)
En lugar de enviar todo de golpe, el Admin leerá la base de datos en bloques (ej. de 1,000 en 1,000) y hará múltiples peticiones `POST` a PolarAPI hasta terminar.

> [!WARNING]
> ### Problema Arquitectónico Detectado (¡Requiere decisión!)
> Actualmente, cuando PolarAPI recibe datos, los guarda en su tabla Maestra e **inmediatamente** ejecuta un proceso que lee *toda* la tabla Maestra y la reparte a los Tenants. 
> Si el Admin le envía la data en 10 pedazos (chunks), la PolarAPI va a ejecutar la repartición masiva a los tenants **10 veces**, lo cual colapsará los tenants.

## Opciones de Solución para la Sincronización

Para solucionar el problema de enviar en Chunks sin colapsar la PolarAPI, tenemos dos opciones:

**OPCIÓN A: Sincronización Inteligente por Chunk**
Modificamos la PolarAPI para que cuando reciba un chunk (ej. 1000 registros), **solo** envíe a los tenants esos 1000 registros específicos, en lugar de leer toda la tabla Maestra de nuevo. Es más eficiente, pero requiere cambiar la lógica profunda de PolarAPI.

**OPCIÓN B: Separar la Carga de la Distribución (2 Pasos)**
Modificamos la PolarAPI para crear dos endpoints separados:
1. `Endpoint 1 (/sync/upload)`: El Admin envía los chunks. PolarAPI solo los guarda en la tabla Maestra de forma silenciosa.
2. `Endpoint 2 (/sync/distribute)`: Cuando el Admin termina de enviar todos los chunks, hace un llamado a este endpoint. Aquí, PolarAPI toma toda su tabla Maestra y la reparte a los tenants en un solo proceso.

---

## Verification Plan
1. Subir un Excel de prueba de gran tamaño (ej. 5,000 filas) y verificar el tiempo de procesamiento en el Job (debe ser muy rápido).
2. Monitorear el uso de memoria de PHP.
3. Ejecutar la sincronización y verificar en los logs de Admin y PolarAPI que los datos se envíen de forma fraccionada y lleguen a los tenants correctamente.
