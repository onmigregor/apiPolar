<?php

namespace Modules\Discount\Mappers;

use App\Traits\HasMapperTransform;

class DiscountMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'dis_code' => ['disCode', 'DIS_CODE', 'dis_code'],
        'dis_name' => ['disName', 'DIS_NAME', 'dis_name'],
    ];
}
