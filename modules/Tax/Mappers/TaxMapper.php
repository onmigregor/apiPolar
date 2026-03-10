<?php

namespace Modules\Tax\Mappers;

use App\Traits\HasMapperTransform;

class TaxMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'tax_code' => ['taxCode', 'TAX_CODE', 'tax_code'],
        'tax_name' => ['taxName', 'TAX_NAME', 'tax_name'],
    ];
}
