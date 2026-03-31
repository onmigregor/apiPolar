<?php

namespace Modules\CustomerCity\Actions;

use Modules\CustomerCity\Models\CustomerCity;

class CustomerCityDeleteAction
{
    public function execute(CustomerCity $customer_city): void
    {
        $customer_city->delete();
    }
}
