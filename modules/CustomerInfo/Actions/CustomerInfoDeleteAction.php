<?php

namespace Modules\CustomerInfo\Actions;

use Modules\CustomerInfo\Models\CustomerInfo;

class CustomerInfoDeleteAction
{
    public function execute(CustomerInfo $customerInfo): void
    {
        $customerInfo->delete();
    }
}
