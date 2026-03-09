<?php

namespace Modules\ProductCategory\Actions;

use Modules\ProductCategory\Models\ProductCategory;

class ProductCategoryDeleteAction
{
    public function execute(ProductCategory $productCategory): void
    {
        $productCategory->delete();
    }
}
