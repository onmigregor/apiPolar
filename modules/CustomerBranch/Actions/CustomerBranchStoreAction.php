<?php

namespace Modules\CustomerBranch\Actions;

use Modules\CustomerBranch\DataTransferObjects\CustomerBranchData;
use Modules\CustomerBranch\Models\CustomerBranch;

class CustomerBranchStoreAction
{
    public function execute(CustomerBranchData $data): CustomerBranch
    {
        return CustomerBranch::create([
            'tp2_code' => $data->tp2_code,
            'tp2_name' => $data->tp2_name,
        ]);
    }
}
