<?php

namespace Modules\Tax\Actions;

use Modules\Tax\DataTransferObjects\TaxData;
use Modules\Tax\Models\Tax;

class TaxUpdateAction
{
    public function execute(Tax $tax, TaxData $data): Tax
    {
        $tax->update([
            'tax_code' => $data->tax_code,
            'tax_name' => $data->tax_name,
        ]);

        return $tax->fresh();
    }
}
