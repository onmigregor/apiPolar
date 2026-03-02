<?php

namespace Modules\CustomerPrice\Actions;

use Modules\CustomerPrice\DataTransferObjects\CustomerPriceData;
use Modules\CustomerPrice\Models\CustomerPrice;

class CustomerPriceUpdateAction
{
    public function execute(CustomerPrice $customerPrice, CustomerPriceData $data): CustomerPrice
    {
        $customerPrice->update([
            'rot_code' => $data->rot_code,
            'cus_code' => $data->cus_code,
            'prc_code' => $data->prc_code,
        ]);

        return $customerPrice->fresh();
    }
}
