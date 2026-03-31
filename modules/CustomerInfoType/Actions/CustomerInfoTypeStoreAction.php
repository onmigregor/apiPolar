<?php

namespace Modules\CustomerInfoType\Actions;

use Modules\CustomerInfoType\DataTransferObjects\CustomerInfoTypeData;
use Modules\CustomerInfoType\Models\CustomerInfoType;

class CustomerInfoTypeStoreAction
{
    public function execute(CustomerInfoTypeData $data): CustomerInfoType
    {
        return CustomerInfoType::create([
            'ift_code'      => $data->ift_code,
            'ift_name'      => $data->ift_name,
            'ift_char_type' => $data->ift_char_type,
        ]);
    }
}
