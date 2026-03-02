<?php

namespace Modules\Product\Actions;

use Modules\Product\Models\Product;

class ProductDeleteAction
{
    public function execute(Product $product): void
    {
        $product->delete();
    }
}
