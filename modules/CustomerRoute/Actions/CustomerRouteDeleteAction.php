<?php

namespace Modules\CustomerRoute\Actions;

use Modules\CustomerRoute\Models\CustomerRoute;

class CustomerRouteDeleteAction
{
    public function execute(CustomerRoute $customerRoute): void
    {
        $customerRoute->delete();
    }
}
