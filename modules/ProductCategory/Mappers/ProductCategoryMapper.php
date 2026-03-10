<?php

namespace Modules\ProductCategory\Mappers;

use App\Traits\HasMapperTransform;

class ProductCategoryMapper
{
    use HasMapperTransform;

    public static array $map = [
        'cl2_code' => ['cl2Code', 'CL2_CODE', 'cl2_code', 'cl2code'],
        'cl1_code' => ['cl1Code', 'CL1_CODE', 'cl1_code', 'cl1code'],
        'cl2_name' => ['cl2Name', 'CL2_NAME', 'cl2_name', 'cl2name'],
    ];
}

