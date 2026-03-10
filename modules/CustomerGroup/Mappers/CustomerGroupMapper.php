<?php

namespace Modules\CustomerGroup\Mappers;

use App\Traits\HasMapperTransform;

class CustomerGroupMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'tp1_code' => ['tp1Code'],
        'tp1_name' => ['tp1Name'],
    ];
}
