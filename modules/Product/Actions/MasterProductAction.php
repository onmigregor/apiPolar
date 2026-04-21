<?php

namespace Modules\Product\Actions;

use Illuminate\Support\Facades\DB;
use Modules\Unit\Mappers\UnitMapper;
use Modules\ProductFamily\Mappers\ProductFamilyMapper;
use Modules\ProductCategory\Mappers\ProductCategoryMapper;
use Modules\ProductClass3\Mappers\ProductClass3Mapper;
use Modules\Product\Mappers\ProductMapper;
use Modules\ProductUnit\Mappers\ProductUnitMapper;

use Modules\Unit\Models\Unit;
use Modules\ProductFamily\Models\ProductFamily;
use Modules\ProductCategory\Models\ProductCategory;
use Modules\ProductClass3\Models\ProductClass3;
use Modules\Product\Models\Product;
use Modules\ProductUnit\Models\ProductUnit;

class MasterProductAction
{
    private static array $fillableCache = [];

    private array $keyMap = [
        'unit'         => ['unit', 'Unidades', 'product unit'],
        'class1'       => ['class1', 'Familias', 'familiaTb'],
        'class2'       => ['class2', 'Categorias', 'categoriaTb'],
        'class3'       => ['class3', 'Subcategorias', 'subcategoriaTb'],
        'product'      => ['product', 'Productos'],
        'productUnit'  => ['productUnit', 'productunit', 'UnidadesProducto', 'product unit'],
    ];

    /**
     * Ejecuta la carga masiva de datos maestros de producto.
     */
    public function execute(array $payload, ?\App\Models\BulkImportLog $log = null): array
    {
        $value = $payload;
        if (isset($payload[0]['name']) && strtoupper($payload[0]['name']) === 'PRODUCTS') {
            $value = $payload[0]['value'];
        }

        return DB::transaction(function () use ($value, $log) {
            $results = [];

            // 1. Unidades de medida (unit)
            $results['unit'] = $this->processCollection(
                $this->getRecords($value, 'unit'),
                Unit::class,
                UnitMapper::class,
                'unt_code'
            );
            if ($log) $log->update(['progress' => 15]);

            // 2. Familias de producto (class1)
            $results['class1'] = $this->processCollection(
                $this->getRecords($value, 'class1'),
                ProductFamily::class,
                ProductFamilyMapper::class,
                'cl1_code'
            );
            if ($log) $log->update(['progress' => 30]);

            // 3. Categorías de producto (class2)
            $results['class2'] = $this->processCollection(
                $this->getRecords($value, 'class2'),
                ProductCategory::class,
                ProductCategoryMapper::class,
                'cl2_code'
            );
            if ($log) $log->update(['progress' => 45]);

            // 4. Class 3 de producto (class3)
            $results['class3'] = $this->processCollection(
                $this->getRecords($value, 'class3'),
                ProductClass3::class,
                ProductClass3Mapper::class,
                'cl3_code'
            );
            if ($log) $log->update(['progress' => 60]);

            // 5. Productos (product)
            $results['product'] = $this->processCollection(
                $this->getRecords($value, 'product'),
                Product::class,
                ProductMapper::class,
                'pro_code'
            );
            if ($log) $log->update(['progress' => 80]);

            // 6. Unidades de producto (productUnit)
            $results['productUnit'] = $this->processCollection(
                $this->getRecords($value, 'productUnit'),
                ProductUnit::class,
                ProductUnitMapper::class,
                ['pro_code', 'unt_code']
            );
            if ($log) $log->update(['progress' => 95]);

            return $results;
        });
    }

    /**
     * Obtiene los registros de un nodo de forma robusta.
     */
    private function getRecords(array $data, string $internalKey): array
    {
        $normalizedData = [];
        foreach ($data as $k => $v) {
            $normK = strtolower(str_replace(' ', '', $k));
            $normalizedData[$normK] = $v;
        }

        $aliases = $this->keyMap[$internalKey] ?? [$internalKey];
        foreach ($aliases as $alias) {
            $normAlias = strtolower(str_replace(' ', '', $alias));
            if (isset($normalizedData[$normAlias]) && is_array($normalizedData[$normAlias])) {
                return $normalizedData[$normAlias];
            }
        }

        return [];
    }

    /**
     * Procesa una colección de registros.
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

            $row = array_fill_keys($fillable, null);
            foreach ($transformed as $key => $val) {
                if (in_array($key, $fillable)) {
                    // Sanitización: Convertir "" o "?" a null globalmente
                    $row[$key] = ($val === '' || $val === '?') ? null : $val;
                }
            }

            $row['updated_at'] = $now;
            $row['created_at'] = $now;

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
