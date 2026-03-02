<?php

namespace Modules\DiscountDetailRoute\Actions;

use Modules\DiscountDetailRoute\DataTransferObjects\DiscountDetailRouteData;
use Modules\DiscountDetailRoute\Models\DiscountDetailRoute;

class DiscountDetailRouteStoreAction
{
    public function execute(DiscountDetailRouteData $data): DiscountDetailRoute
    {
        return DiscountDetailRoute::create([
            'rot_code' => $data->rot_code,
            'dis_code' => $data->dis_code,
        ]);
    }
}
