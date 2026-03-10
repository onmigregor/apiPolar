<?php

namespace Modules\DiscountDetailRoute\Mappers;

use App\Traits\HasMapperTransform;

class DiscountDetailRouteMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'rot_code' => ['rotCode', 'ROT_CODE', 'rot_code'],
        'dis_code' => ['disCode', 'DIS_CODE', 'dis_code'],
    ];
}
