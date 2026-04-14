<?php

namespace Modules\Company\Mappers;

use App\Traits\HasMapperTransform;

class LoginBranchMapper
{
    use HasMapperTransform;

    public static array $map = [
        'lgn_code' => ['lgnCode', 'LGN_CODE', 'lgn_code'],
        'brc_code' => ['brcCode', 'BRC_CODE', 'brc_code'],
    ];
}
