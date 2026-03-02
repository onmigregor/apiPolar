<?php

namespace Modules\DiscountDetailProduct\Actions;

use Modules\DiscountDetailProduct\Models\DiscountDetailProduct;

class DiscountDetailProductDeleteAction
{
    public function execute(DiscountDetailProduct $discountDetailProduct): void
    {
        $discountDetailProduct->delete();
    }
}
