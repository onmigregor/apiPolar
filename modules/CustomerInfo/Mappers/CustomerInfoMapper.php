<?php

namespace Modules\CustomerInfo\Mappers;

use App\Traits\HasMapperTransform;

class CustomerInfoMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'cus_code'       => ['cusCode', 'CUS_CODE', 'cus_code'],
        'ift_code'       => ['iftCode', 'IFT_CODE', 'ift_code'],
        'ctn_char_value' => ['ctnCharValue', 'CTN_CHAR_VALUE', 'ctn_char_value'],
    ];
}
