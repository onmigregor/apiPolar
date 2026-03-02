<?php

namespace Modules\DiscountDetail\Actions;

use Modules\DiscountDetail\DataTransferObjects\DiscountDetailData;
use Modules\DiscountDetail\Models\DiscountDetail;

class DiscountDetailStoreAction
{
    public function execute(DiscountDetailData $data): DiscountDetail
    {
        return DiscountDetail::create([
            'dis_code'          => $data->dis_code,
            'did_code'          => $data->did_code,
            'did_name'          => $data->did_name,
            'rot_code_customer' => $data->rot_code_customer,
            'cus_code'          => $data->cus_code,
            'did_since'         => $data->did_since,
            'did_until'         => $data->did_until,
        ]);
    }
}
