<?php

namespace Modules\Promotion\Actions;

use Illuminate\Support\Facades\DB;
use Modules\Promotion\DataTransferObjects\PromotionData;
use Modules\PromotionDetail\Actions\StorePromotionDetailAction;
use Modules\PromotionDetail\DataTransferObjects\PromotionDetailData;
use Modules\PromotionDetailProduct\Actions\StorePromotionDetailProductAction;
use Modules\PromotionDetailProduct\DataTransferObjects\PromotionDetailProductData;
use Modules\PromotionRoute\Actions\StorePromotionRouteAction;
use Modules\PromotionRoute\DataTransferObjects\PromotionRouteData;
use Modules\PromotionTeam\Actions\StorePromotionTeamAction;
use Modules\PromotionTeam\DataTransferObjects\PromotionTeamData;
use Exception;

class MasterPromotionAction
{
    public function __construct(
        private StorePromotionAction $storePromotionAction,
        private StorePromotionDetailAction $storePromotionDetailAction,
        private StorePromotionDetailProductAction $storePromotionDetailProductAction,
        private StorePromotionRouteAction $storePromotionRouteAction,
        private StorePromotionTeamAction $storePromotionTeamAction
    ) {}

    public function execute(array $payloadList): array
    {
        $totals = [
            'promotions' => ['created' => 0, 'updated' => 0],
            'promotionDetail' => ['created' => 0, 'updated' => 0],
            'promotionDetailProduct' => ['created' => 0, 'updated' => 0],
            'promotionRoute' => ['created' => 0, 'updated' => 0],
            'promotionTeam' => ['created' => 0, 'updated' => 0],
        ];

        DB::transaction(function () use ($payloadList, &$totals) {
            foreach ($payloadList as $block) {
                // 1. Cabecera (Promotion)
                if (isset($block['promotion']) && is_array($block['promotion'])) {
                    foreach ($block['promotion'] as $promoItem) {
                        $promoDto = PromotionData::fromArray($promoItem);
                        $promo = $this->storePromotionAction->execute($promoDto);
                        
                        if ($promo->wasRecentlyCreated) {
                            $totals['promotions']['created']++;
                        } else {
                            $totals['promotions']['updated']++;
                        }
                    }
                }

                // 2. Detalle (PromotionDetail)
                if (isset($block['promotionDetail']) && is_array($block['promotionDetail'])) {
                    foreach ($block['promotionDetail'] as $detail) {
                        $detailDto = PromotionDetailData::fromArray($detail);
                        $det = $this->storePromotionDetailAction->execute($detailDto);
                        
                        if ($det->wasRecentlyCreated) {
                            $totals['promotionDetail']['created']++;
                        } else {
                            $totals['promotionDetail']['updated']++;
                        }
                    }
                }

                // 3. Productos (PromotionDetailProduct)
                if (isset($block['promotionDetailProduct']) && is_array($block['promotionDetailProduct'])) {
                    foreach ($block['promotionDetailProduct'] as $product) {
                        $productDto = PromotionDetailProductData::fromArray($product);
                        $prod = $this->storePromotionDetailProductAction->execute($productDto);
                        
                        if ($prod->wasRecentlyCreated) {
                            $totals['promotionDetailProduct']['created']++;
                        } else {
                            $totals['promotionDetailProduct']['updated']++;
                        }
                    }
                }

                // 4. Rutas (PromotionRoute)
                if (isset($block['promotionRoute']) && is_array($block['promotionRoute'])) {
                    foreach ($block['promotionRoute'] as $route) {
                        $routeDto = PromotionRouteData::fromArray($route);
                        $rot = $this->storePromotionRouteAction->execute($routeDto);
                        
                        if ($rot->wasRecentlyCreated) {
                            $totals['promotionRoute']['created']++;
                        } else {
                            $totals['promotionRoute']['updated']++;
                        }
                    }
                }

                // 5. Equipos (PromotionTeam)
                if (isset($block['promotionTeam']) && is_array($block['promotionTeam'])) {
                    foreach ($block['promotionTeam'] as $team) {
                        $teamDto = PromotionTeamData::fromArray($team);
                        $tea = $this->storePromotionTeamAction->execute($teamDto);
                        
                        if ($tea->wasRecentlyCreated) {
                            $totals['promotionTeam']['created']++;
                        } else {
                            $totals['promotionTeam']['updated']++;
                        }
                    }
                }
            }
        });

        return [
            'status' => 'success',
            'totals' => $totals
        ];
    }
}
