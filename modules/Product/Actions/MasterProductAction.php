<?php

namespace Modules\Product\Actions;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Unit\Mappers\UnitMapper;
use Modules\ProductFamily\Mappers\ProductFamilyMapper;
use Modules\ProductCategory\Mappers\ProductCategoryMapper;
use Modules\Product\Mappers\ProductMapper;
use Modules\ProductUnit\Mappers\ProductUnitMapper;

use Modules\Unit\Models\Unit;
use Modules\ProductFamily\Models\ProductFamily;
use Modules\ProductCategory\Models\ProductCategory;
use Modules\Product\Models\Product;
use Modules\ProductUnit\Models\ProductUnit;

class MasterProductAction
{
    /** Cache estático de $fillable por modelo para evitar re-instanciación */
    private static array $fillableCache = [];

    /**
     * Ejecuta la carga masiva de datos maestros de producto.
     *
     * Recibe el payload de Polar en formato:
     * [{ "name": "PRODUCTS", "value": { "unit": [...], "class1": [...], "class2": [...], "product": [...], "productUnit": [...] } }]
     *
     * Procesa cada sección en orden de dependencias dentro de una transacción.
     *
     * @param array $payload El payload completo del JSON de Polar
     * @return array Conteo de registros procesados y omitidos por sección
     */
    public function execute(array $payload): array
    {
        // Extraer el nodo "value" del wrapper de Polar
        $value = $payload[0]['value'] ?? $payload;

        return DB::transaction(function () use ($value) {
            $results = [];

            // 1. Unidades de medida (no depende de nadie)
            if (!empty($value['unit'])) {
                $results['unit'] = $this->processCollection(
                    $value['unit'],
                    Unit::class,
                    UnitMapper::class,
                    'unt_code'
                );
            }

            // 2. Familias de producto — class1 (no depende de nadie)
            if (!empty($value['class1'])) {
                $results['class1_productFamily'] = $this->processCollection(
                    $value['class1'],
                    ProductFamily::class,
                    ProductFamilyMapper::class,
                    'cl1_code'
                );
            }

            // 3. Categorías de producto — class2 (depende de class1)
            if (!empty($value['class2'])) {
                $results['class2_productCategory'] = $this->processCollection(
                    $value['class2'],
                    ProductCategory::class,
                    ProductCategoryMapper::class,
                    'cl2_code'
                );
            }

            // 4. Productos (depende de unit, class2)
            if (!empty($value['product'])) {
                $results['product'] = $this->processCollection(
                    $value['product'],
                    Product::class,
                    ProductMapper::class,
                    'pro_code'
                );
            }

            // 5. Unidades de producto (depende de product y unit)
            if (!empty($value['productUnit'])) {
                $results['productUnit'] = $this->processCollection(
                    $value['productUnit'],
                    ProductUnit::class,
                    ProductUnitMapper::class,
                    ['pro_code', 'unt_code'] // clave compuesta
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
                Log::warning('MasterProduct: Registro omitido por clave inválida', [
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
