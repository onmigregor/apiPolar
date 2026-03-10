<?php

namespace Modules\PriceProduct\Mappers;

use App\Traits\HasMapperTransform;

class PriceProductMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'prc_code'         => ['prcCode', 'PRC_CODE', 'prc_code'],
        'pro_code'         => ['proCode', 'PRO_CODE', 'pro_code'],
        'unt_code'         => ['untCode', 'UNT_CODE', 'unt_code'],
        'ppr_date1'        => ['pprDate1', 'PPR_DATE1', 'ppr_date1'],
        'ppr_price1_date1' => ['pprPrice1Date1', 'PPR_PRICE1_DATE1', 'ppr_price1_date1'],
    ];
}
