<?php

namespace Modules\Tax\Actions;

use Modules\Tax\DataTransferObjects\TaxData;
use Modules\Tax\Models\Tax;

class TaxStoreAction
{
    public function execute(TaxData $data): Tax
    {
        return Tax::create([
            'tax_code' => $data->tax_code,
            'tax_name' => $data->tax_name,
        ]);
    }
}
