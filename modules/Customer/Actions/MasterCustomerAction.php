<?php

namespace Modules\Customer\Actions;

use Illuminate\Support\Facades\DB;
use Modules\Customer\Mappers\CustomerMapper;
use Modules\CustomerGroup\Mappers\CustomerGroupMapper;
use Modules\CustomerBranch\Mappers\CustomerBranchMapper;
use Modules\CustomerCity\Mappers\CustomerCityMapper;
use Modules\CustomerFrequency\Mappers\CustomerFrequencyMapper;
use Modules\CustomerRoute\Mappers\CustomerRouteMapper;
use Modules\CustomerInfoType\Mappers\CustomerInfoTypeMapper;
use Modules\CustomerPrice\Mappers\CustomerPriceMapper;
use Modules\CustomerInfo\Mappers\CustomerInfoMapper;

use Modules\Customer\Models\Customer;
use Modules\CustomerGroup\Models\CustomerGroup;
use Modules\CustomerBranch\Models\CustomerBranch;
use Modules\CustomerCity\Models\CustomerCity;
use Modules\CustomerFrequency\Models\CustomerFrequency;
use Modules\CustomerRoute\Models\CustomerRoute;
use Modules\CustomerInfoType\Models\CustomerInfoType;
use Modules\CustomerPrice\Models\CustomerPrice;
use Modules\CustomerInfo\Models\CustomerInfo;

class MasterCustomerAction
{
    private static array $fillableCache = [];

    /**
     * Estandarización de llaves: Polar Name -> Internal Key
     */
    private array $keyMap = [
        'type1'         => ['type1', 'GrupoCliente'],
        'type2'         => ['type2', 'ramoCliente'],
        'city'          => ['city', 'regionCliente'],
        'frequency'     => ['frequency', 'frecuenciaTb'],
        'infoType'      => ['infoType', 'licenciaTb'],
        'customer'      => ['customer', 'Clientes'],
        'customerRoute' => ['customerRoute', 'frecuenciaCliente'],
        'customerPrice' => ['customerPrice', 'preciosCliente'],
        'customerInfo'  => ['customerInfo', 'informacionCliente'],
    ];

    public function execute(array $payload): array
    {
        // El payload puede ser un array de objetos con name/value o el value directamente
        $value = $payload;
        if (isset($payload[0]['name']) && $payload[0]['name'] === 'CUSTOMERS') {
            $value = $payload[0]['value'];
        }

        return DB::transaction(function () use ($value) {
            $results = [];

            // 1. GrupoCliente (type1)
            $results['GrupoCliente'] = $this->processCollection(
                $this->getRecords($value, 'type1'),
                CustomerGroup::class,
                CustomerGroupMapper::class,
                'tp1_code'
            );

            // 2. ramoCliente (type2)
            $results['ramoCliente'] = $this->processCollection(
                $this->getRecords($value, 'type2'),
                CustomerBranch::class,
                CustomerBranchMapper::class,
                'tp2_code'
            );

            // 3. regionCliente (city)
            $results['regionCliente'] = $this->processCollection(
                $this->getRecords($value, 'city'),
                CustomerCity::class,
                CustomerCityMapper::class,
                'cit_code'
            );

            // 4. frecuenciaTb (frequency)
            $results['frecuenciaTb'] = $this->processCollection(
                $this->getRecords($value, 'frequency'),
                CustomerFrequency::class,
                CustomerFrequencyMapper::class,
                'fre_code'
            );

            // 5. licenciaTb (infoType)
            $results['licenciaTb'] = $this->processCollection(
                $this->getRecords($value, 'infoType'),
                CustomerInfoType::class,
                CustomerInfoTypeMapper::class,
                'ift_code'
            );

            // 6. Clientes (customer)
            $results['Clientes'] = $this->processCollection(
                $this->getRecords($value, 'customer'),
                Customer::class,
                CustomerMapper::class,
                'cus_code'
            );

            // 7. frecuenciaCliente (customerRoute)
            $results['frecuenciaCliente'] = $this->processCollection(
                $this->getRecords($value, 'customerRoute'),
                CustomerRoute::class,
                CustomerRouteMapper::class,
                ['rot_code', 'cus_code', 'fre_code']
            );
            
            // 8. preciosCliente (customerPrice)
            $results['preciosCliente'] = $this->processCollection(
                $this->getRecords($value, 'customerPrice'),
                CustomerPrice::class,
                CustomerPriceMapper::class,
                ['rot_code', 'cus_code', 'prc_code']
            );
            
            // 9. informacionCliente (customerInfo)
            $results['informacionCliente'] = $this->processCollection(
                $this->getRecords($value, 'customerInfo'),
                CustomerInfo::class,
                CustomerInfoMapper::class,
                ['cus_code', 'ift_code']
            );

            return $results;
        });
    }

    /**
     * Obtiene los registros de un nodo intentando con todas las variantes del mapa.
     */
    private function getRecords(array $data, string $internalKey): array
    {
        $aliases = $this->keyMap[$internalKey] ?? [$internalKey];
        foreach ($aliases as $alias) {
            if (isset($data[$alias]) && is_array($data[$alias])) {
                return $data[$alias];
            }
        }
        return [];
    }

    /**
     * Procesa una colección de registros: mapea, filtra, deduplica y hace upsert.
     */
    private function processCollection(array $records, string $modelClass, string $mapperClass, string|array $uniqueKey): array
    {
        if (empty($records)) {
            return ['processed' => 0, 'skipped' => 0, 'duplicates_removed' => 0];
        }

        if (!isset(self::$fillableCache[$modelClass])) {
            self::$fillableCache[$modelClass] = (new $modelClass)->getFillable();
        }
        $fillable = self::$fillableCache[$modelClass];
        $uniqueKeys = is_array($uniqueKey) ? $uniqueKey : [$uniqueKey];
        $now = now();
        $skipped = 0;
        $deduplicated = [];

        foreach ($records as $record) {
            unset($record['controller'], $record['deleted']);

            $transformed = $mapperClass::transform($record);

            // Filtrar registros inválidos
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
                continue;
            }

            // Homologación de llaves
            $row = array_fill_keys($fillable, null);
            foreach ($transformed as $key => $val) {
                if (in_array($key, $fillable)) {
                    $row[$key] = $val;
                }
            }

            $row['updated_at'] = $now;
            $row['created_at'] = $now;

            // Deduplicación
            $compositeKey = implode('|', array_map(fn($k) => $row[$k] ?? '', $uniqueKeys));
            $deduplicated[$compositeKey] = $row;
        }

        $mapped = array_values($deduplicated);
        $duplicatesRemoved = count($records) - $skipped - count($mapped);

        if (empty($mapped)) {
            return ['processed' => 0, 'skipped' => $skipped, 'duplicates_removed' => $duplicatesRemoved];
        }

        $allColumns = array_keys($mapped[0]);
        $updateColumns = array_diff($allColumns, $uniqueKeys);

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
