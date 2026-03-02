<?php

namespace Modules\CustomerGroup\Actions;

use Modules\CustomerGroup\DataTransferObjects\CustomerGroupData;
use Modules\CustomerGroup\Models\CustomerGroup;

class CustomerGroupStoreAction
{
    public function execute(CustomerGroupData $data): CustomerGroup
    {
        return CustomerGroup::create([
            'tp1_code' => $data->tp1_code,
            'tp1_name' => $data->tp1_name,
        ]);
    }
}
