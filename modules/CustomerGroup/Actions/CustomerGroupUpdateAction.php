<?php

namespace Modules\CustomerGroup\Actions;

use Modules\CustomerGroup\DataTransferObjects\CustomerGroupData;
use Modules\CustomerGroup\Models\CustomerGroup;

class CustomerGroupUpdateAction
{
    public function execute(CustomerGroup $customerGroup, CustomerGroupData $data): CustomerGroup
    {
        $customerGroup->update([
            'tp1_code' => $data->tp1_code,
            'tp1_name' => $data->tp1_name,
        ]);

        return $customerGroup->fresh();
    }
}
