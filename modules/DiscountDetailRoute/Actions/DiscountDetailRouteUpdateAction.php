<?php

namespace Modules\DiscountDetailRoute\Actions;

use Modules\DiscountDetailRoute\DataTransferObjects\DiscountDetailRouteData;
use Modules\DiscountDetailRoute\Models\DiscountDetailRoute;

class DiscountDetailRouteUpdateAction
{
    public function execute(DiscountDetailRoute $discountDetailRoute, DiscountDetailRouteData $data): DiscountDetailRoute
    {
        $discountDetailRoute->update([
            'rot_code' => $data->rot_code,
            'dis_code' => $data->dis_code,
        ]);

        return $discountDetailRoute->fresh();
    }
}
