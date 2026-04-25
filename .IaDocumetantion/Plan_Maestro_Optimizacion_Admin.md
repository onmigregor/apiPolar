# Plan Maestro de Optimización — Admin (productosPolarApi)

Este documento detalla las mejoras necesarias para garantizar la escalabilidad y estabilidad del panel de administración.

## 1. Estabilización de Configuración (Blindaje Anti-Caché)
**Problema**: El uso de `env()` fuera de los archivos de configuración provoca errores de "Unauthenticated" cuando se activa la caché de Laravel.
**Acción**: 
- Crear `config/polar.php` para centralizar `api_url` y `api_token`.
- Refactorizar los 7 módulos para usar `config('polar.api_token')`.

## 2. Optimización de Importaciones (Excel)
**Problema**: Las importaciones actuales (ADC, Planes, Precios) procesan fila por fila con `updateOrCreate`, lo que genera miles de consultas a la DB.
**Acción**: 
- Implementar `upsert()` masivo por bloques (chunks) de 500 registros.
- Reducción esperada de tiempo: 90%.

## 3. Optimización de Envío (Sincronización API)
**Problema**: El uso de `Model::all()->toArray()` puede agotar la memoria RAM con grandes volúmenes de datos.
**Acción**: 
- Cambiar a `Model::chunkById(500, ...)` para enviar datos a la API de forma fraccionada.
- Esto permitirá sincronizar millones de registros sin afectar el rendimiento del servidor.

---
**Prioridad**: Alta. Estos cambios previenen caídas del sistema en producción.
