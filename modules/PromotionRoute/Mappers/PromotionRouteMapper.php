<?php

namespace Modules\PromotionRoute\Mappers;

use Modules\PromotionRoute\DataTransferObjects\PromotionRouteData;

class PromotionRouteMapper
{
    public static function toDatabase(PromotionRouteData $dto): array
    {
        return [
            'rot_code' => $dto->rotCode,
            'prm_code' => $dto->prmCode,
        ];
    }
}
