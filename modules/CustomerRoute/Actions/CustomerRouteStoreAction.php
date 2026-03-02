<?php

namespace Modules\CustomerRoute\Actions;

use Modules\CustomerRoute\DataTransferObjects\CustomerRouteData;
use Modules\CustomerRoute\Models\CustomerRoute;

class CustomerRouteStoreAction
{
    public function execute(CustomerRouteData $data): CustomerRoute
    {
        return CustomerRoute::create([
            'rot_code'      => $data->rot_code,
            'cus_code'      => $data->cus_code,
            'fre_code'      => $data->fre_code,
            'ctr_monday'    => $data->ctr_monday,
            'ctr_tuesday'   => $data->ctr_tuesday,
            'ctr_wednesday' => $data->ctr_wednesday,
            'ctr_thursday'  => $data->ctr_thursday,
            'ctr_friday'    => $data->ctr_friday,
        ]);
    }
}
