<?php

namespace Modules\CustomerInfo\Actions;

use Modules\CustomerInfo\DataTransferObjects\CustomerInfoData;
use Modules\CustomerInfo\Models\CustomerInfo;

class CustomerInfoStoreAction
{
    public function execute(CustomerInfoData $data): CustomerInfo
    {
        return CustomerInfo::create([
            'cus_code'       => $data->cus_code,
            'ift_code'       => $data->ift_code,
            'ctn_char_value' => $data->ctn_char_value,
        ]);
    }
}
