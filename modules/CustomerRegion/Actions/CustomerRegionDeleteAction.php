<?php

namespace Modules\CustomerRegion\Actions;

use Modules\CustomerRegion\Models\CustomerRegion;

class CustomerRegionDeleteAction
{
    public function execute(CustomerRegion $customerRegion): void
    {
        $customerRegion->delete();
    }
}
