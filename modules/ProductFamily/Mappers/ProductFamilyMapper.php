<?php

namespace Modules\ProductFamily\Mappers;

use App\Traits\HasMapperTransform;

class ProductFamilyMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'cl1_code' => ['cl1Code', 'CL1_CODE', 'cl1_code', 'cl1code'],
        'cl1_name' => ['cl1Name', 'CL1_NAME', 'cl1_name', 'cl1name'],
    ];
}

