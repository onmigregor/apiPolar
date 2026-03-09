<?php

namespace Modules\ProductFamily\Actions;

use Modules\ProductFamily\Models\ProductFamily;

class ProductFamilyDeleteAction
{
    public function execute(ProductFamily $productFamily): void
    {
        $productFamily->delete();
    }
}
