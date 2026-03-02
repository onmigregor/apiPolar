<?php

namespace Modules\ProductUnit\Actions;

use Modules\ProductUnit\DataTransferObjects\ProductUnitData;
use Modules\ProductUnit\Models\ProductUnit;

class ProductUnitUpdateAction
{
    public function execute(ProductUnit $productUnit, ProductUnitData $data): ProductUnit
    {
        $productUnit->update([
            'pro_code'      => $data->pro_code,
            'unt_code'      => $data->unt_code,
            'pru_divide_by' => $data->pru_divide_by,
        ]);

        return $productUnit->fresh();
    }
}
