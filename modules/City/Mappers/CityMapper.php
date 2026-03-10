<?php

namespace Modules\City\Mappers;

use App\Traits\HasMapperTransform;

class CityMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'cit_code' => ['citCode', 'CIT_CODE', 'cit_code'],
        'cit_name' => ['citName', 'CIT_NAME', 'cit_name'],
        'sta_code' => ['staCode', 'STA_CODE', 'sta_code'],
    ];
}
