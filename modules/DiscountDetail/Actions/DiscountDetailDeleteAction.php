<?php

namespace Modules\DiscountDetail\Actions;

use Modules\DiscountDetail\Models\DiscountDetail;

class DiscountDetailDeleteAction
{
    public function execute(DiscountDetail $discountDetail): void
    {
        $discountDetail->delete();
    }
}
