<?php

namespace Modules\Price\Actions;

use Modules\Price\DataTransferObjects\PriceData;
use Modules\Price\Models\Price;

class PriceUpdateAction
{
    public function execute(Price $price, PriceData $data): Price
    {
        $price->update([
            'prc_code' => $data->prc_code,
            'prc_name' => $data->prc_name,
        ]);

        return $price->fresh();
    }
}
