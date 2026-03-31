<?php

namespace Modules\PromotionTeam\Mappers;

use App\Traits\HasMapperTransform;

class PromotionTeamMapper
{
    use HasMapperTransform;

    public static array $map = [
        'tea_code' => ['teaCode', 'tea_code', 'TEACODE'],
        'prm_code' => ['prmCode', 'prm_code', 'PRMCODE'],
    ];
}
