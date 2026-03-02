<?php

namespace Modules\Discount\Actions;

use Modules\Discount\DataTransferObjects\DiscountData;
use Modules\Discount\Models\Discount;

class DiscountStoreAction
{
    public function execute(DiscountData $data): Discount
    {
        return Discount::create([
            'dis_code' => $data->dis_code,
            'dis_name' => $data->dis_name,
        ]);
    }
}
