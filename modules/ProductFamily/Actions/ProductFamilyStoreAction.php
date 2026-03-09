<?php

namespace Modules\ProductFamily\Actions;

use Modules\ProductFamily\DataTransferObjects\ProductFamilyData;
use Modules\ProductFamily\Models\ProductFamily;

class ProductFamilyStoreAction
{
    public function execute(ProductFamilyData $data): ProductFamily
    {
        return ProductFamily::create([
            'cl1_code' => $data->cl1_code,
            'cl1_name' => $data->cl1_name,
        ]);
    }
}
