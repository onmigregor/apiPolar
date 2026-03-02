<?php

namespace Modules\ProductUnit\Actions;

use Modules\ProductUnit\DataTransferObjects\ProductUnitData;
use Modules\ProductUnit\Models\ProductUnit;

class ProductUnitStoreAction
{
    public function execute(ProductUnitData $data): ProductUnit
    {
        return ProductUnit::create([
            'pro_code'      => $data->pro_code,
            'unt_code'      => $data->unt_code,
            'pru_divide_by' => $data->pru_divide_by,
        ]);
    }
}
