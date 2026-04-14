<?php

namespace Modules\Company\Mappers;

use App\Traits\HasMapperTransform;

class CrewLoginMapper
{
    use HasMapperTransform;

    public static array $map = [
        'crw_code' => ['crwCode', 'CRW_CODE', 'crw_code'],
        'lgn_code' => ['lgnCode', 'LGN_CODE', 'lgn_code'],
    ];
}
