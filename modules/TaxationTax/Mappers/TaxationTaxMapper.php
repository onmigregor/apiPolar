<?php

namespace Modules\TaxationTax\Mappers;

use App\Traits\HasMapperTransform;

class TaxationTaxMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'ttx_code'          => ['ttxCode', 'TTX_CODE', 'ttx_code'],
        'txn_code'          => ['txnCode', 'TXN_CODE', 'txn_code'],
        'tax_code'          => ['taxCode', 'TAX_CODE', 'tax_code'],
        'ttx_date1'         => ['ttxDate1', 'TTX_DATE1', 'ttx_date1'],
        'pro_code'          => ['proCode', 'PRO_CODE', 'pro_code'],
        'ttx_percent_date1' => ['ttxPercentDate1', 'TTX_PERCENT_DATE1', 'ttx_percent_date1'],
        'unt_code'          => ['untCode', 'UNT_CODE', 'unt_code'],
    ];
}
