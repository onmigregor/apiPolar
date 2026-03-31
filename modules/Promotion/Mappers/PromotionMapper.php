<?php

namespace Modules\Promotion\Mappers;

use App\Traits\HasMapperTransform;

class PromotionMapper
{
    use HasMapperTransform;

    public static array $map = [
        'prm_code' => ['prmCode', 'prm_code', 'PRMCODE'],
        'prm_name' => ['prmName', 'prm_name', 'PRMNAME'],
    ];
}
