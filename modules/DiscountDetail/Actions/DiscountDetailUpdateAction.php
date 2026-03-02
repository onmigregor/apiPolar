<?php

namespace Modules\DiscountDetail\Actions;

use Modules\DiscountDetail\DataTransferObjects\DiscountDetailData;
use Modules\DiscountDetail\Models\DiscountDetail;

class DiscountDetailUpdateAction
{
    public function execute(DiscountDetail $discountDetail, DiscountDetailData $data): DiscountDetail
    {
        $discountDetail->update([
            'dis_code'          => $data->dis_code,
            'did_code'          => $data->did_code,
            'did_name'          => $data->did_name,
            'rot_code_customer' => $data->rot_code_customer,
            'cus_code'          => $data->cus_code,
            'did_since'         => $data->did_since,
            'did_until'         => $data->did_until,
        ]);

        return $discountDetail->fresh();
    }
}
