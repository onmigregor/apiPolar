<?php

namespace Modules\ProductUnit\Mappers;

use App\Traits\HasMapperTransform;

class ProductUnitMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'pro_code'      => ['proCode', 'PRO_CODE', 'pro_code'],
        'unt_code'      => ['untCode', 'UNT_CODE', 'unt_code'],
        'pru_divide_by' => ['pruDivideBy', 'PRU_DIVIDE_BY', 'pru_divide_by'],
    ];
}

