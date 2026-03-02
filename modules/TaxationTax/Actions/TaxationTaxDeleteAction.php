<?php

namespace Modules\TaxationTax\Actions;

use Modules\TaxationTax\Models\TaxationTax;

class TaxationTaxDeleteAction
{
    public function execute(TaxationTax $taxationTax): void
    {
        $taxationTax->delete();
    }
}
