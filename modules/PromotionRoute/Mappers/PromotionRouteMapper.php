<?php

namespace Modules\PromotionRoute\Mappers;

use App\Traits\HasMapperTransform;

class PromotionRouteMapper
{
    use HasMapperTransform;

    public static array $map = [
        'rot_code' => ['rotCode', 'rot_code', 'ROTCODE'],
        'prm_code' => ['prmCode', 'prm_code', 'PRMCODE'],
    ];
}
