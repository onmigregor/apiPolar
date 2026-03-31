<?php

namespace Modules\Promotion\Actions;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Promotion\Mappers\PromotionMapper;
use Modules\Promotion\Models\Promotion;
use Modules\PromotionDetail\Mappers\PromotionDetailMapper;
use Modules\PromotionDetail\Models\PromotionDetail;
use Modules\PromotionDetailProduct\Mappers\PromotionDetailProductMapper;
use Modules\PromotionDetailProduct\Models\PromotionDetailProduct;
use Modules\PromotionRoute\Mappers\PromotionRouteMapper;
use Modules\PromotionRoute\Models\PromotionRoute;
use Modules\PromotionTeam\Mappers\PromotionTeamMapper;
use Modules\PromotionTeam\Models\PromotionTeam;
use Exception;

class MasterPromotionAction
{
    private static array $fillableCache = [];

    public function execute(array $payloadList): array
    {
        return DB::transaction(function () use ($payloadList) {
            // Unificamos todos los bloques "value" del payload
            $unified = [
                'promotion' => [],
                'promotionDetail' => [],
                'promotionDetailProduct' => [],
                'promotionRoute' => [],
                'promotionTeam' => [],
            ];

            foreach ($payloadList as $block) {
                foreach ($unified as $key => &$list) {
                    if (isset($block[$key]) && is_array($block[$key])) {
                        $list = array_merge($list, $block[$key]);
                    }
                }
            }

            $detailResults = [];

            // 1. Cabecera (Promotion)
            $detailResults['promotion'] = $this->processCollection(
                $unified['promotion'],
                Promotion::class,
                PromotionMapper::class,
                'prm_code'
            );

            // 2. Detalle (PromotionDetail)
            $detailResults['promotionDetail'] = $this->processCollection(
                $unified['promotionDetail'],
                PromotionDetail::class,
                PromotionDetailMapper::class,
                'pdl_code'
            );

            // 3. Productos (PromotionDetailProduct)
            $detailResults['promotionDetailProduct'] = $this->processCollection(
                $unified['promotionDetailProduct'],
                PromotionDetailProduct::class,
                PromotionDetailProductMapper::class,
                'prp_code'
            );

            // 4. Rutas (PromotionRoute)
            $detailResults['promotionRoute'] = $this->processCollection(
                $unified['promotionRoute'],
                PromotionRoute::class,
                PromotionRouteMapper::class,
                ['rot_code', 'prm_code']
            );

            // 5. Equipos (PromotionTeam)
            $detailResults['promotionTeam'] = $this->processCollection(
                $unified['promotionTeam'],
                PromotionTeam::class,
                PromotionTeamMapper::class,
                ['tea_code', 'prm_code']
            );

            // Calcular totales para el resumen
            $totalProcessed = 0;
            $totalSkipped = 0;
            $totalDuplicates = 0;

            foreach ($detailResults as $res) {
                $totalProcessed += $res['processed'];
                $totalSkipped += $res['skipped'];
                $totalDuplicates += $res['duplicates_removed'];
            }

            return [
                'status' => 'success',
                'summary' => [
                    'total_processed' => $totalProcessed,
                    'total_skipped' => $totalSkipped,
                    'total_duplicates' => $totalDuplicates,
                ],
                'detail' => $detailResults
            ];
        });
    }

    /**
     * Procesa una colección de registros: mapea, filtra, deduplica y hace upsert.
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
