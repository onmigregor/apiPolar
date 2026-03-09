<?php

namespace Modules\ProductCategory\Actions;

use Modules\ProductCategory\DataTransferObjects\ProductCategoryData;
use Modules\ProductCategory\Models\ProductCategory;

class ProductCategoryUpdateAction
{
    public function execute(ProductCategory $productCategory, ProductCategoryData $data): ProductCategory
    {
        $productCategory->update([
            'cl2_code' => $data->cl2_code,
            'cl1_code' => $data->cl1_code,
            'cl2_name' => $data->cl2_name,
        ]);
        return $productCategory->fresh();
    }
}
