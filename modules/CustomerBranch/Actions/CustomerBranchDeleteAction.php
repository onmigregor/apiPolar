<?php

namespace Modules\CustomerBranch\Actions;

use Modules\CustomerBranch\Models\CustomerBranch;

class CustomerBranchDeleteAction
{
    public function execute(CustomerBranch $customerBranch): void
    {
        $customerBranch->delete();
    }
}
