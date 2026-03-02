<?php

namespace Modules\PriceProduct\Actions;

use Modules\PriceProduct\Models\PriceProduct;

class PriceProductDeleteAction
{
    public function execute(PriceProduct $priceProduct): void
    {
        $priceProduct->delete();
    }
}
