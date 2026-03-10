<?php

namespace Modules\CustomerPrice\Mappers;

use App\Traits\HasMapperTransform;

class CustomerPriceMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'rot_code' => ['rotCode', 'ROT_CODE', 'rot_code'],
        'cus_code' => ['cusCode', 'CUS_CODE', 'cus_code'],
        'prc_code' => ['prcCode', 'PRC_CODE', 'prc_code'],
    ];
}
