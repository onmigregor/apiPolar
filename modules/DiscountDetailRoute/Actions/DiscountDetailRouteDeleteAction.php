<?php

namespace Modules\DiscountDetailRoute\Actions;

use Modules\DiscountDetailRoute\Models\DiscountDetailRoute;

class DiscountDetailRouteDeleteAction
{
    public function execute(DiscountDetailRoute $discountDetailRoute): void
    {
        $discountDetailRoute->delete();
    }
}
