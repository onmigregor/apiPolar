<?php

namespace Modules\CustomerBranch\Actions;

use Modules\CustomerBranch\DataTransferObjects\CustomerBranchData;
use Modules\CustomerBranch\Models\CustomerBranch;

class CustomerBranchUpdateAction
{
    public function execute(CustomerBranch $customerBranch, CustomerBranchData $data): CustomerBranch
    {
        $customerBranch->update([
            'tp2_code' => $data->tp2_code,
            'tp2_name' => $data->tp2_name,
        ]);
        return $customerBranch->fresh();
    }
}
