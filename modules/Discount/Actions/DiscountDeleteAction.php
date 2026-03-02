<?php

namespace Modules\Discount\Actions;

use Modules\Discount\Models\Discount;

class DiscountDeleteAction
{
    public function execute(Discount $discount): void
    {
        $discount->delete();
    }
}
