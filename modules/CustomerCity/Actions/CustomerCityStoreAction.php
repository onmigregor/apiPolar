<?php

namespace Modules\CustomerCity\Actions;

use Modules\CustomerCity\DataTransferObjects\CustomerCityData;
use Modules\CustomerCity\Models\CustomerCity;

class CustomerCityStoreAction
{
    public function execute(CustomerCityData $data): CustomerCity
    {
        return CustomerCity::create([
            'cit_code' => $data->cit_code,
            'cit_name' => $data->cit_name,
            'sta_code' => $data->sta_code,
        ]);
    }
}
