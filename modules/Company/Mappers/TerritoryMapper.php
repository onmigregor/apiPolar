<?php

namespace Modules\Company\Mappers;

use App\Traits\HasMapperTransform;

class TerritoryMapper
{
    use HasMapperTransform;

    public static array $map = [
        'try_code' => ['tryCode', 'TRY_CODE', 'try_code'],
        'brc_code' => ['brcCode', 'BRC_CODE', 'brc_code'],
        'lgn_code' => ['lgnCode', 'LGN_CODE', 'lgn_code'],
        'try_name' => ['tryName', 'TRY_NAME', 'try_name'],
    ];
}
