<?php

namespace Modules\Company\Mappers;

use App\Traits\HasMapperTransform;

class BranchMapper
{
    use HasMapperTransform;

    public static array $map = [
        'brc_code'            => ['brcCode', 'BRC_CODE', 'brc_code'],
        'brc_name'            => ['brcName', 'BRC_NAME', 'brc_name'],
        'brc_general_header1' => ['brcGeneralHeader1', 'BRC_GENERAL_HEADER1', 'brc_general_header1'],
        'reg_code'            => ['regCode', 'REG_CODE', 'reg_code'],
    ];
}
