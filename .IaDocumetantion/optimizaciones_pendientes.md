# 🚀 Hoja de Ruta: Optimizaciones Pendientes (Bulk Import System)

Este documento detalla las mejoras técnicas identificadas para el sistema de importación masiva de productos de Polar, enfocadas en escalabilidad, rendimiento y mantenimiento preventivo.

---

## 🛠️ Optimizaciones Implementadas
- [x] **Frontend inteligente (Polling Condicional):** El sistema ya no sobrecarga el servidor. La tabla solo realiza consultas automáticas cada 5 segundos si detecta que hay una carga activa en segundo plano.

---

## 📋 Pendientes para Próximas Fases

### 1. 🧠 Procesamiento con "Streaming JSON"
**Prioridad:** Alta (Si el archivo supera los 25MB)
- **Problema actual:** Usamos `json_decode`, que carga todo el archivo en la memoria RAM. Esto limitará el tamaño máximo del catálogo.
- **Propuesta:** Integrar `halaxa/json-machine`. 
- **Beneficio:** Permitirá procesar catálogos de cientos de megabytes (o gigabytes) usando menos de 10MB de RAM, manteniendo la estabilidad del servidor PHP.

### 2. ⚡ Sintonización de Base de Datos (SQL Tuning)
**Prioridad:** Media
- **Problema actual:** Los bloques de inserción (`chunks`) están fijos en 500 registros.
- **Propuesta:** 
    - Realizar pruebas de carga para aumentar los bloques a 1,000 o 2,000 registros.
    - Asegurar que `cl3_code` y otros campos de búsqueda tengan índices únicos (`UNIQUE`) en la migración definitiva para que los comandos `UPSERT` sean instantáneos.
- **Beneficio:** Reducción del tiempo total de importación en un 30-40%.

### 3. 🧹 Limpieza Automática de Archivos Huérfanos
**Prioridad:** Baja
- **Problema actual:** Si una carga falla o el servidor se detiene, el archivo temporal queda en el disco ocupando espacio basura.
- **Propuesta:** Implementar un comando programado en el `Kernel.php` (`php artisan app:cleanup-temp-uploads`) que borre archivos en `temp-uploads` con más de 24 horas de antigüedad.
- **Beneficio:** Evita que el disco se llene de archivos basura a largo plazo.

### 4. 🔄 Lógica de Reintentos (Retry Mechanism)
**Prioridad:** Media
- **Problema actual:** Si un registro falla catastróficamente, se marca todo el Job como fallido (o se hace rollback parcial).
- **Propuesta:** Implementar una tabla de "Dead Letter" o errores específicos por registro para que el usuario pueda ver exactamente qué productos fallaron sin detener el resto de la carga.
- **Beneficio:** Mayor resiliencia ante errores de formato de data origen.

---

> [!NOTE]
> Se recomienda priorizar la **Optimización #1** si se planea manejar catálogos consolidados de múltiples países o distribuidores en un solo archivo.
