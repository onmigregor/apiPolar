<?php

namespace Modules\CustomerCity\Actions;

use Modules\CustomerCity\DataTransferObjects\CustomerCityData;
use Modules\CustomerCity\Models\CustomerCity;

class CustomerCityUpdateAction
{
    public function execute(CustomerCity $customer_city, CustomerCityData $data): CustomerCity
    {
        $customer_city->update([
            'cit_code' => $data->cit_code,
            'cit_name' => $data->cit_name,
            'sta_code' => $data->sta_code,
        ]);

        return $customer_city->fresh();
    }
}
