<?php
namespace Modules\Product\Mappers;

use App\Traits\HasMapperTransform;

class ProductClass4Mapper
{
    use HasMapperTransform;

    public static array $map = [
        'cl4_code' => ['cl4code', 'CL4CODE', 'cl4_code'],
        'cl4_name' => ['cl4name', 'CL4NAME', 'cl4_name'],
        'brand_code' => ['brand_code'],
        'segment_code' => ['segment_code'],
    ];
}
