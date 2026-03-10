<?php

namespace Modules\Taxation\Mappers;

use App\Traits\HasMapperTransform;

class TaxationMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'txn_code' => ['txnCode', 'TXN_CODE', 'txn_code'],
        'txn_name' => ['txnName', 'TXN_NAME', 'txn_name'],
    ];
}
