<?php

namespace Modules\CustomerBranch\Mappers;

use App\Traits\HasMapperTransform;

class CustomerBranchMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'tp2_code' => ['tp2Code'],
        'tp2_name' => ['tp2Name'],
    ];
}
