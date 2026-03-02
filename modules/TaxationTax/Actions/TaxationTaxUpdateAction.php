<?php

namespace Modules\TaxationTax\Actions;

use Modules\TaxationTax\DataTransferObjects\TaxationTaxData;
use Modules\TaxationTax\Models\TaxationTax;

class TaxationTaxUpdateAction
{
    public function execute(TaxationTax $taxationTax, TaxationTaxData $data): TaxationTax
    {
        $taxationTax->update([
            'ttx_code'          => $data->ttx_code,
            'txn_code'          => $data->txn_code,
            'tax_code'          => $data->tax_code,
            'ttx_date1'         => $data->ttx_date1,
            'pro_code'          => $data->pro_code,
            'ttx_percent_date1' => $data->ttx_percent_date1,
            'unt_code'          => $data->unt_code,
        ]);

        return $taxationTax->fresh();
    }
}
