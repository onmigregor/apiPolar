<?php

namespace Modules\Customer\Actions;

use Modules\Customer\Models\Customer;

class CustomerDeleteAction
{
    public function execute(Customer $customer): void
    {
        $customer->delete();
    }
}
