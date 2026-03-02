<?php

namespace Modules\PriceProduct\Actions;

use Modules\PriceProduct\DataTransferObjects\PriceProductData;
use Modules\PriceProduct\Models\PriceProduct;

class PriceProductUpdateAction
{
    public function execute(PriceProduct $priceProduct, PriceProductData $data): PriceProduct
    {
        $priceProduct->update([
            'prc_code'         => $data->prc_code,
            'pro_code'         => $data->pro_code,
            'unt_code'         => $data->unt_code,
            'ppr_date1'        => $data->ppr_date1,
            'ppr_price1_date1' => $data->ppr_price1_date1,
        ]);

        return $priceProduct->fresh();
    }
}
