<?php

namespace Modules\ProductFamily\Actions;

use Modules\ProductFamily\DataTransferObjects\ProductFamilyData;
use Modules\ProductFamily\Models\ProductFamily;

class ProductFamilyUpdateAction
{
    public function execute(ProductFamily $productFamily, ProductFamilyData $data): ProductFamily
    {
        $productFamily->update([
            'cl1_code' => $data->cl1_code,
            'cl1_name' => $data->cl1_name,
        ]);

        return $productFamily->fresh();
    }
}
