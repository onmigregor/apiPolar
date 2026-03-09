<?php

namespace Modules\ProductCategory\Actions;

use Modules\ProductCategory\DataTransferObjects\ProductCategoryData;
use Modules\ProductCategory\Models\ProductCategory;

class ProductCategoryStoreAction
{
    public function execute(ProductCategoryData $data): ProductCategory
    {
        return ProductCategory::create([
            'cl2_code' => $data->cl2_code,
            'cl1_code' => $data->cl1_code,
            'cl2_name' => $data->cl2_name,
        ]);
    }
}
