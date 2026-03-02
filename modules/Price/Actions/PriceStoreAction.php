<?php

namespace Modules\Price\Actions;

use Modules\Price\DataTransferObjects\PriceData;
use Modules\Price\Models\Price;

class PriceStoreAction
{
    public function execute(PriceData $data): Price
    {
        return Price::create([
            'prc_code' => $data->prc_code,
            'prc_name' => $data->prc_name,
        ]);
    }
}
