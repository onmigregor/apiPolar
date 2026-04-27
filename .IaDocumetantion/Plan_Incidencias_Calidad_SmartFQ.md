# Plan de Incidencias SmartFQ en Calidad — Análisis y Estado

Documento generado a partir del archivo `Incidencias SmartFQ en Calidad (1).xlsx`.
Fecha de análisis: 27/04/2026.

---

## Resumen Ejecutivo

| ID | Descripción | Prioridad | Estado |
|----|-------------|-----------|--------|
| 1 | Tabla GENERAL no visible | Baja | ⬜ PENDIENTE |
| 2 | Nombres con guión bajo en Customer | Baja | ⬜ PENDIENTE |
| 3 | Campos faltantes en CUSTOMER | Muy Alta | ✅ RESUELTO |
| 4 | Campos faltantes en FREQUENCY | Baja | ✅ RESUELTO (sin data) |
| 5 | Tabla TYPE3 no existe en API | Muy Alta | ✅ RESUELTO |
| 6 | Tabla TYPE2 se llama Branches | Muy Alta | ✅ RESUELTO |
| 7 | Tabla TYPE1 se llama Groups | Baja | ⬜ PENDIENTE (verificar) |
| 8 | Campos faltantes en CUSTOMER PRICE | Baja | ⬜ PENDIENTE (Fase 2) |
| 9 | Campos faltantes en CUSTOMER ROUTE | Mediana | ⬜ PENDIENTE |
| 10 | Campos faltantes en PRODUCT + PRODUCTUNIT + CLASS4 | Muy Alta | 🟡 PARCIAL |
| 11 | Homologar nombre tabla Branch (Companies) | Baja | ⬜ PENDIENTE (verificar) |
| 12 | Campos faltantes en Login (Companies) | Muy Alta | ⬜ PENDIENTE |
| 13 | Campos faltantes en Territory (Companies) | Muy Alta | ⬜ PENDIENTE |
| 14 | Error Internal Server en API Promociones | Muy Alta | ⬜ PENDIENTE |

---

## Detalle por Incidencia

---

### ID 1 — Tabla GENERAL no visible
- **Prioridad**: Baja
- **Estado**: ⬜ PENDIENTE
- **Descripción**: No se visualiza la tabla "GENERAL" en el sistema.
- **Plan de acción**: 
  1. Confirmar qué datos contiene la tabla "GENERAL" del JSON de Polar.
  2. Crear el endpoint/vista correspondiente en la PolarAPI para exponerla.
  3. Si es solo visual (Swagger/UI), agregar la ruta al grupo de documentación.

---

### ID 2 — Nombres con guión bajo en Customer
- **Prioridad**: Baja
- **Estado**: ⬜ PENDIENTE
- **Descripción**: Los nombres de los clientes en la tabla Customer tienen separadores con guión bajo (`_`) en vez de espacios.
- **Plan de acción**:
  1. Identificar en el flujo de importación (JSON → Admin → API) dónde se inyectan los guiones bajos.
  2. Aplicar un `str_replace('_', ' ', $nombre)` en el proceso de normalización antes del `upsert`.
  3. Verificar que no afecte a búsquedas existentes que dependan de ese formato.

---

### ID 3 — Campos faltantes en CUSTOMER
- **Prioridad**: Muy Alta
- **Estado**: ✅ **RESUELTO**
- **Campos solicitados**: `tp1code, tp2code, tp3code, metCode1, citCode, txnCode, cusPhone, cusStreet1, cusStreet3, cusTaxId1`
- **Evidencia**:
  - Migración `2026_04_08_035850_add_polar_fields_to_master_clients_table.php` añadió: `tp1_code`, `tp2_code`, `cit_code`, `txn_code`, `cus_phone`, `cus_street1`, `cus_street2`, `cus_street3`, `cus_tax_id1`.
  - Modelo `MasterClient.php` tiene todos los campos en `$fillable`.
  - Acción `SyncOfficialCustomersAction.php` mapea todos estos campos a los tenants.
- **Pendiente menor**: El campo `metCode1` no fue encontrado en el código. Verificar si es un campo válido del JSON o si fue descartado intencionalmente.

---

### ID 4 — Campos faltantes en FREQUENCY
- **Prioridad**: Baja
- **Estado**: ✅ **RESUELTO** (sin data disponible)
- **Campos solicitados**: `freWeek2, freWeek3, freWeek4, freCustomer`
- **Observación del equipo**: "SE HIZO AJUSTE MAS NO HAY DATA PARA VISUALIZAR, SE REVISARON LOS JSONS Y NO HAY DATA PARA ESOS CAMPOS".
- **Verificación**: No se encontró implementación de estos campos en el código, lo cual es consistente con que los JSONs no traen esa data. No hay acción requerida a menos que los JSONs se actualicen.

---

### ID 5 — Tabla TYPE3 no existe en API
- **Prioridad**: Muy Alta
- **Estado**: ✅ **RESUELTO**
- **Descripción**: La tabla TYPE3 (Segmentos de clientes) no existía como módulo separado.
- **Evidencia**:
  - Modelo `MasterClientSegment.php` creado → tabla `master_clients_segments`.
  - Migración `2026_04_23_170441_create_master_clients_segments_table.php` con campos `tp3_code` (unique) y `tp3_name`.
  - Controlador `MasterClientController.php` recibe `segments` en el request.
  - Acción `MasterClientBulkSyncAction.php` procesa y distribuye los segmentos a los tenants.

---

### ID 6 — Tabla TYPE2 se llama Branches
- **Prioridad**: Muy Alta
- **Estado**: ✅ **RESUELTO**
- **Descripción**: La tabla TYPE2 (Tipología de clientes) se llamaba "Branches" en vez de TYPE2.
- **Evidencia**:
  - Modelo `MasterClientBranch.php` creado → tabla `master_clients_branches`.
  - Migración `2026_04_23_164659_create_master_clients_branches_table.php` con campo `tp2_code` (unique).
  - Acción `MasterClientBulkSyncAction.php` mapea `tp2_code` → `TipoCliente` en los tenants.
- **Nota**: El nombre "Branches" es intencional del lado de la API (nomenclatura interna). En los tenants se traduce a `TipoCliente`.

---

### ID 7 — Tabla TYPE1 se llama Groups
- **Prioridad**: Baja
- **Estado**: ⬜ PENDIENTE (verificar nomenclatura)
- **Descripción**: La tabla TYPE1 se llama "Groups" y necesita homologación de nombre.
- **Plan de acción**:
  1. El campo `tp1_code` ya existe en `MasterClient` y se sincroniza a los tenants.
  2. Verificar si necesita una tabla auxiliar separada (como se hizo con Branches y Segments) o si la relación directa por código es suficiente.
  3. Si se requiere tabla, crear `master_clients_groups` con `tp1_code` y `tp1_name`.

---

### ID 8 — Campos faltantes en CUSTOMER PRICE
- **Prioridad**: Baja
- **Estado**: ⬜ PENDIENTE (planificado para Fase 2)
- **Campos solicitados**: `cspForSale, cspForReturn`
- **Descripción**: Relacionar la lista de precios que le corresponde a cada cliente.
- **Plan de acción**:
  1. Este trabajo se relaciona directamente con el módulo `ProductsPrice` que acabamos de crear.
  2. Cuando se implemente la asignación de precios por cliente, se añadirán estos campos para indicar precios de venta y devolución por cliente.

---

### ID 9 — Campos faltantes en CUSTOMER ROUTE
- **Prioridad**: Mediana
- **Campos solicitados**: `ctrMonday, ctrTuesday, ctrWednesday, ctrThursday, ctrFriday, ctrSaturday, ctrSunday, ctrContactPerson, ctrBalance, prcCodeForSale, conCode`
- **Estado**: ⬜ PENDIENTE
- **Plan de acción**:
  1. Verificar si estos campos ya existen en la tabla `master_client_routes` o equivalente.
  2. Crear migración para añadir las columnas faltantes.
  3. Actualizar el proceso de importación del JSON de clientes para mapear estos campos.
  4. Los campos de días (Monday-Sunday) son relevantes para el plan de visita.

---

### ID 10 — Campos faltantes en PRODUCT + PRODUCTUNIT + CLASS4
- **Prioridad**: Muy Alta
- **Estado**: 🟡 **PARCIALMENTE RESUELTO**

#### Lo que YA está implementado:
- `cl2_code` (Class2/Categoría) ✅ — Migración, modelo y sincronización a tenants.
- `cl3_code` (Class3/Subcategoría) ✅ — Migración, modelo y sincronización a tenants.
- `unt_code` (Unidad de medida) ✅ — Migración, modelo y sincronización a tenants.

#### Lo que FALTA:
| Campo | Tabla | Descripción | Criticidad |
|-------|-------|-------------|------------|
| `proShortName` | product | Nombre corto del producto | Baja |
| `proBarcode` | product | Código de barras | Media |
| `bomCode` | product | Código de lista de materiales | Baja |
| `cl4Code` | product | Marca (Class4) | **MUY ALTA** |
| `proReturnAllowed` | product | Permite devolución | Media |
| `proDamageReturnsAllowed` | product | Permite devolución por daño | Media |
| `proAvailableForSale` | product | Disponible para venta | Alta |
| `proCustomerInventoryAllowed` | product | Permite inventario de cliente | Baja |
| `pruMultiplBy` | productunit | Multiplicador por unidad de medida (ej: CJ=24) | **MUY ALTA** |

- **Plan de acción**:
  1. **Class4 (Marcas)**: Crear tabla `master_product_class_4` y modelo. Añadir `cl4_code` a `master_products`. Actualizar importación de JSON.
  2. **pruMultiplBy**: Añadir columna `pru_multipl_by` a `master_product_units`. Actualizar la importación.
  3. **Campos de producto restantes**: Crear migración para añadir `pro_short_name`, `pro_barcode`, `bom_code`, `pro_return_allowed`, `pro_damage_returns_allowed`, `pro_available_for_sale`, `pro_customer_inventory_allowed` a `master_products`.
  4. Actualizar los DTOs y las acciones de sincronización.

---

### ID 11 — Homologar nombre tabla Branch (Companies)
- **Prioridad**: Baja
- **Estado**: ⬜ PENDIENTE
- **Descripción**: Homologar los nombres de las tablas en el módulo de Companies.
- **Plan de acción**:
  1. Auditar los nombres actuales de las tablas del módulo Companies en la API.
  2. Crear un documento de mapeo: `Nombre JSON Polar → Nombre en API → Nombre en Tenants`.
  3. Aplicar renombramientos si es necesario vía migraciones.

---

### ID 12 — Campos faltantes en Login (Companies)
- **Prioridad**: Muy Alta
- **Campos solicitados**: `lgnPhone, lgnStreet1, lgnStreet2, lgnStreet3, srgCode`
- **Estado**: ⬜ PENDIENTE
- **Descripción**: Estos campos son clave para la agrupación de franquiciados y datos como listas de precios.
- **Plan de acción**:
  1. Verificar la estructura actual de la tabla `logins` en el módulo Companies de la API.
  2. Crear migración para añadir `lgn_phone`, `lgn_street1`, `lgn_street2`, `lgn_street3`, `srg_code`.
  3. Actualizar el proceso de importación del JSON de Companies para mapear estos campos.
  4. **Nota**: `lgnStreet1` contiene el código de franquicia (ej: `N013 Porlamar Pampatar`), el cual es clave para el módulo de Precios.

---

### ID 13 — Campos faltantes en Territory (Companies)
- **Prioridad**: Muy Alta
- **Campos solicitados**: `TryEmail (tipo de ruta), PMI (Vendedor/Despachador), PVT (Preventa tradicional), PVE (Preventa especializada)`
- **Estado**: ⬜ PENDIENTE
- **Descripción**: Necesarios para crear las diferentes rutas o vendedores y preventistas de un franquiciado, y la asignación de clientes por vendedor.
- **Plan de acción**:
  1. Verificar la estructura actual de la tabla `territories` en el módulo Companies.
  2. Crear migración para añadir `try_email`, `pmi`, `pvt`, `pve`.
  3. Actualizar el proceso de importación del JSON de Companies.

---

### ID 14 — Error Internal Server en API Promociones
- **Prioridad**: Muy Alta
- **Estado**: ⬜ PENDIENTE
- **Descripción**: La API de promociones arroja "Internal Server Error".
- **Plan de acción**:
  1. Reproducir el error accediendo al endpoint de promociones en Swagger o vía `curl`.
  2. Revisar los logs de la PolarAPI (`storage/logs/laravel.log`) para obtener el stack trace.
  3. Diagnosticar si es un error de base de datos (tabla faltante, columna inexistente) o de lógica (controlador/acción).
  4. Aplicar la corrección correspondiente.

---

## Próximos Pasos Recomendados (Por Prioridad)

| Orden | Incidencia | Prioridad | Esfuerzo |
|-------|-----------|-----------|----------|
| 1 | **ID 10** — Class4 + pruMultiplBy + campos producto | Muy Alta | Alto |
| 2 | **ID 14** — Error API Promociones | Muy Alta | Medio (diagnóstico) |
| 3 | **ID 12** — Campos Login (Companies) | Muy Alta | Medio |
| 4 | **ID 13** — Campos Territory (Companies) | Muy Alta | Medio |
| 5 | **ID 9** — Campos Customer Route | Mediana | Medio |
| 6 | **ID 7** — Homologar TYPE1/Groups | Baja | Bajo |
| 7 | **ID 11** — Homologar Branch (Companies) | Baja | Bajo |
| 8 | **ID 2** — Guiones bajos en nombres | Baja | Bajo |
| 9 | **ID 1** — Tabla GENERAL | Baja | Bajo |
| 10 | **ID 8** — Customer Price (Fase 2) | Baja | Medio |
