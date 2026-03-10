<?php

namespace Modules\Customer\Actions;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Customer\Mappers\CustomerMapper;
use Modules\CustomerGroup\Mappers\CustomerGroupMapper;
use Modules\CustomerBranch\Mappers\CustomerBranchMapper;
use Modules\CustomerRegion\Mappers\CustomerRegionMapper;
use Modules\CustomerFrequency\Mappers\CustomerFrequencyMapper;
use Modules\CustomerRoute\Mappers\CustomerRouteMapper;
use Modules\InfoType\Mappers\InfoTypeMapper;

use Modules\Customer\Models\Customer;
use Modules\CustomerGroup\Models\CustomerGroup;
use Modules\CustomerBranch\Models\CustomerBranch;
use Modules\CustomerRegion\Models\CustomerRegion;
use Modules\CustomerFrequency\Models\CustomerFrequency;
use Modules\CustomerRoute\Models\CustomerRoute;
use Modules\InfoType\Models\InfoType;

class MasterCustomerAction
{
    /** Cache estático de $fillable por modelo para evitar re-instanciación */
    private static array $fillableCache = [];

    /**
     * Ejecuta la carga masiva de datos maestros de cliente.
     *
     * Recibe el payload de Polar en formato:
     * [{ "name": "CUSTOMERS", "value": { "GrupoCliente": [...], "ramoCliente": [...], ... } }]
     *
     * Procesa cada sección en orden de dependencias dentro de una transacción.
     *
     * @param array $payload El payload completo del JSON de Polar
     * @return array Conteo de registros procesados y omitidos por sección
     */
    public function execute(array $payload): array
    {
        // Extraer el nodo "value" del wrapper de Polar si existe
        $value = $payload[0]['value'] ?? $payload;

        return DB::transaction(function () use ($value) {
            $results = [];

            // 1. GrupoCliente (no depende de nadie)
            if (!empty($value['GrupoCliente'])) {
                $results['GrupoCliente'] = $this->processCollection(
                    $value['GrupoCliente'],
                    CustomerGroup::class,
                    CustomerGroupMapper::class,
                    'tp1_code'
                );
            }

            // 2. ramoCliente (no depende de nadie)
            if (!empty($value['ramoCliente'])) {
                $results['ramoCliente'] = $this->processCollection(
                    $value['ramoCliente'],
                    CustomerBranch::class,
                    CustomerBranchMapper::class,
                    'tp2_code'
                );
            }

            // 3. regionCliente (no depende de nadie)
            if (!empty($value['regionCliente'])) {
                $results['regionCliente'] = $this->processCollection(
                    $value['regionCliente'],
                    CustomerRegion::class,
                    CustomerRegionMapper::class,
                    'cit_code'
                );
            }

            // 4. frecuenciaTb (no depende de nadie)
            if (!empty($value['frecuenciaTb'])) {
                $results['frecuenciaTb'] = $this->processCollection(
                    $value['frecuenciaTb'],
                    CustomerFrequency::class,
                    CustomerFrequencyMapper::class,
                    'fre_code'
                );
            }

            // 5. licenciaTb (no depende de nadie)
            if (!empty($value['licenciaTb'])) {
                $results['licenciaTb'] = $this->processCollection(
                    $value['licenciaTb'],
                    InfoType::class,
                    InfoTypeMapper::class,
                    'ift_code'
                );
            }

            // 6. Clientes (depende de GrupoCliente, ramoCliente, regionCliente)
            if (!empty($value['Clientes'])) {
                $results['Clientes'] = $this->processCollection(
                    $value['Clientes'],
                    Customer::class,
                    CustomerMapper::class,
                    'cus_code'
                );
            }

            // 7. frecuenciaCliente (depende de Clientes y frecuenciaTb)
            if (!empty($value['frecuenciaCliente'])) {
                $results['frecuenciaCliente'] = $this->processCollection(
                    $value['frecuenciaCliente'],
                    CustomerRoute::class,
                    CustomerRouteMapper::class,
                    ['rot_code', 'cus_code', 'fre_code'] // Asumimos esta llave compuesta basada en la migración
                );
            }

            return $results;
        });
    }

    /**
     * Procesa una colección de registros: mapea, filtra, deduplica y hace upsert.
     *
     * @param array $records Registros crudos del JSON
     * @param string $modelClass Clase del modelo Eloquent
     * @param string $mapperClass Clase del Mapper
     * @param string|array $uniqueKey Campo(s) único(s) para upsert
     * @return array ['processed' => int, 'skipped' => int, 'duplicates_removed' => int]
     */
    private function processCollection(array $records, string $modelClass, string $mapperClass, string|array $uniqueKey): array
    {
        if (!isset(self::$fillableCache[$modelClass])) {
            self::$fillableCache[$modelClass] = (new $modelClass)->getFillable();
        }
        $fillable = self::$fillableCache[$modelClass];
        $uniqueKeys = is_array($uniqueKey) ? $uniqueKey : [$uniqueKey];
        $now = now();
        $skipped = 0;
        $deduplicated = [];

        foreach ($records as $record) {
            // Remover metadatos de Polar
            unset($record['controller'], $record['deleted']);

            $transformed = $mapperClass::transform($record);

            // 1. Filtrar registros inválidos (basura de Polar tipo "0000..." o nulos en clave primaria)
            $isInvalid = false;
            foreach ($uniqueKeys as $uk) {
                $checkVal = $transformed[$uk] ?? null;
                if (empty($checkVal) || $checkVal === '0000000000000000' || $checkVal === '?' || $checkVal === 0) {
                    $isInvalid = true;
                    break;
                }
            }
            if ($isInvalid) {
                $skipped++;
                Log::warning('MasterCustomer: Registro omitido por clave inválida o vacía', [
                    'model'  => class_basename($modelClass),
                    'keys'   => array_intersect_key($transformed, array_flip($uniqueKeys)),
                ]);
                continue;
            }

            // 2. Homologación de llaves: cada fila debe tener exactamente los mismos campos
            $row = array_fill_keys($fillable, null);
            foreach ($transformed as $key => $val) {
                if (in_array($key, $fillable)) {
                    $row[$key] = $val;
                }
            }

            // Timestamps uniformes para todo el lote
            $row['updated_at'] = $now;
            $row['created_at'] = $now;

            // 3. Deduplicación: usar la clave compuesta como key del array para quedarnos solo con el último
            $compositeKey = implode('|', array_map(fn($k) => $row[$k] ?? '', $uniqueKeys));
            $deduplicated[$compositeKey] = $row;
        }

        $mapped = array_values($deduplicated);
        $duplicatesRemoved = count($records) - $skipped - count($mapped);

        if (empty($mapped)) {
            return ['processed' => 0, 'skipped' => $skipped, 'duplicates_removed' => $duplicatesRemoved];
        }

        // Definir columnas a actualizar (todas menos las claves únicas)
        $allColumns = array_keys($mapped[0]);
        $updateColumns = array_diff($allColumns, $uniqueKeys);

        // Procesar en lotes de 500 para evitar saturar memoria o SQL
        $chunks = array_chunk($mapped, 500);
        foreach ($chunks as $chunk) {
            $modelClass::upsert($chunk, $uniqueKeys, array_values($updateColumns));
        }

        return [
            'processed'          => count($mapped),
            'skipped'            => $skipped,
            'duplicates_removed' => $duplicatesRemoved,
        ];
    }
}
