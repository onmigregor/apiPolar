<?php

namespace Modules\CustomerPrice\Actions;

use Modules\CustomerPrice\Models\CustomerPrice;

class CustomerPriceDeleteAction
{
    public function execute(CustomerPrice $customerPrice): void
    {
        $customerPrice->delete();
    }
}
