<?php

namespace Modules\Company\Mappers;

use App\Traits\HasMapperTransform;

class LoginMapper
{
    use HasMapperTransform;

    public static array $map = [
        'lgn_code' => ['lgnCode', 'LGN_CODE', 'lgn_code'],
        'lgn_name' => ['lgnName', 'LGN_NAME', 'lgn_name'],
        'brc_code' => ['brcCode', 'BRC_CODE', 'brc_code'],
    ];
}
