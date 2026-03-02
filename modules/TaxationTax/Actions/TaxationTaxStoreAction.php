<?php

namespace Modules\TaxationTax\Actions;

use Modules\TaxationTax\DataTransferObjects\TaxationTaxData;
use Modules\TaxationTax\Models\TaxationTax;

class TaxationTaxStoreAction
{
    public function execute(TaxationTaxData $data): TaxationTax
    {
        return TaxationTax::create([
            'ttx_code'          => $data->ttx_code,
            'txn_code'          => $data->txn_code,
            'tax_code'          => $data->tax_code,
            'ttx_date1'         => $data->ttx_date1,
            'pro_code'          => $data->pro_code,
            'ttx_percent_date1' => $data->ttx_percent_date1,
            'unt_code'          => $data->unt_code,
        ]);
    }
}
