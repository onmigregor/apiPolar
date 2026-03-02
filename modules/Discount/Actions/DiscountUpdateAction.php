<?php

namespace Modules\Discount\Actions;

use Modules\Discount\DataTransferObjects\DiscountData;
use Modules\Discount\Models\Discount;

class DiscountUpdateAction
{
    public function execute(Discount $discount, DiscountData $data): Discount
    {
        $discount->update([
            'dis_code' => $data->dis_code,
            'dis_name' => $data->dis_name,
        ]);

        return $discount->fresh();
    }
}
