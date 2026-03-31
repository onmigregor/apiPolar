<?php

namespace Modules\CustomerInfoType\Actions;

use Modules\CustomerInfoType\DataTransferObjects\CustomerInfoTypeData;
use Modules\CustomerInfoType\Models\CustomerInfoType;

class CustomerInfoTypeUpdateAction
{
    public function execute(CustomerInfoType $customerInfoType, CustomerInfoTypeData $data): CustomerInfoType
    {
        $customerInfoType->update([
            'ift_code'      => $data->ift_code,
            'ift_name'      => $data->ift_name,
            'ift_char_type' => $data->ift_char_type,
        ]);

        return $customerInfoType->fresh();
    }
}
