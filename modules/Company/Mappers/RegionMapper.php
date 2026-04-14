<?php

namespace Modules\Company\Mappers;

use App\Traits\HasMapperTransform;

class RegionMapper
{
    use HasMapperTransform;

    public static array $map = [
        'reg_code' => ['regCode', 'REG_CODE', 'reg_code'],
        'reg_name' => ['regName', 'REG_NAME', 'reg_name'],
    ];
}
