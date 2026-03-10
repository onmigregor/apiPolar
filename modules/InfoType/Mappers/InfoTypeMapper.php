<?php

namespace Modules\InfoType\Mappers;

use App\Traits\HasMapperTransform;

class InfoTypeMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'ift_code'      => ['iftCode', 'IFT_CODE', 'ift_code'],
        'ift_name'      => ['iftName', 'IFT_NAME', 'ift_name'],
        'ift_char_type' => ['iftCharType', 'IFT_CHAR_TYPE', 'ift_char_type'],
    ];
}
