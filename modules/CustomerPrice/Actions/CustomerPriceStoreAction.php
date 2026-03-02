<?php

namespace Modules\CustomerPrice\Actions;

use Modules\CustomerPrice\DataTransferObjects\CustomerPriceData;
use Modules\CustomerPrice\Models\CustomerPrice;

class CustomerPriceStoreAction
{
    public function execute(CustomerPriceData $data): CustomerPrice
    {
        return CustomerPrice::create([
            'rot_code' => $data->rot_code,
            'cus_code' => $data->cus_code,
            'prc_code' => $data->prc_code,
        ]);
    }
}
