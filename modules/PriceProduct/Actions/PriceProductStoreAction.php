<?php

namespace Modules\PriceProduct\Actions;

use Modules\PriceProduct\DataTransferObjects\PriceProductData;
use Modules\PriceProduct\Models\PriceProduct;

class PriceProductStoreAction
{
    public function execute(PriceProductData $data): PriceProduct
    {
        return PriceProduct::create([
            'prc_code'         => $data->prc_code,
            'pro_code'         => $data->pro_code,
            'unt_code'         => $data->unt_code,
            'ppr_date1'        => $data->ppr_date1,
            'ppr_price1_date1' => $data->ppr_price1_date1,
        ]);
    }
}
