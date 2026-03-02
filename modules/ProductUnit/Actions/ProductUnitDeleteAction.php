<?php

namespace Modules\ProductUnit\Actions;

use Modules\ProductUnit\Models\ProductUnit;

class ProductUnitDeleteAction
{
    public function execute(ProductUnit $productUnit): void
    {
        $productUnit->delete();
    }
}
