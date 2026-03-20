<?php

namespace Modules\PromotionRoute\Actions;

use Modules\PromotionRoute\Models\PromotionRoute;
use Modules\PromotionRoute\DataTransferObjects\PromotionRouteData;
use Modules\PromotionRoute\Mappers\PromotionRouteMapper;

class StorePromotionRouteAction
{
    public function execute(PromotionRouteData $dto): PromotionRoute
    {
        $data = PromotionRouteMapper::toDatabase($dto);
        return PromotionRoute::updateOrCreate(
            ['rot_code' => $dto->rotCode, 'prm_code' => $dto->prmCode],
            $data
        );
    }
}
