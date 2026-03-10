<?php

namespace Modules\Price\Mappers;

use App\Traits\HasMapperTransform;

class PriceMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'prc_code' => ['prcCode', 'PRC_CODE', 'prc_code'],
        'prc_name' => ['prcName', 'PRC_NAME', 'prc_name'],
    ];
}
