<?php

namespace Modules\Price\Actions;

use Modules\Price\Models\Price;

class PriceDeleteAction
{
    public function execute(Price $price): void
    {
        $price->delete();
    }
}
