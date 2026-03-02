<?php

namespace Modules\CustomerGroup\Actions;

use Modules\CustomerGroup\Models\CustomerGroup;

class CustomerGroupDeleteAction
{
    public function execute(CustomerGroup $customerGroup): void
    {
        $customerGroup->delete();
    }
}
