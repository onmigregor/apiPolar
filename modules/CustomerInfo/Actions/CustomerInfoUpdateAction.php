<?php

namespace Modules\CustomerInfo\Actions;

use Modules\CustomerInfo\DataTransferObjects\CustomerInfoData;
use Modules\CustomerInfo\Models\CustomerInfo;

class CustomerInfoUpdateAction
{
    public function execute(CustomerInfo $customerInfo, CustomerInfoData $data): CustomerInfo
    {
        $customerInfo->update([
            'cus_code'       => $data->cus_code,
            'ift_code'       => $data->ift_code,
            'ctn_char_value' => $data->ctn_char_value,
        ]);

        return $customerInfo->fresh();
    }
}
