<?php

namespace Modules\CustomerRegion\Mappers;

use App\Traits\HasMapperTransform;

class CustomerRegionMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'cit_code' => ['citCode'],
        'cit_name' => ['citName'],
        'sta_code' => ['staCode'],
    ];
}
