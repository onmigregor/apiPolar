<?php

namespace Modules\City\Actions;

use Modules\City\DataTransferObjects\CityData;
use Modules\City\Models\City;

class CityStoreAction
{
    public function execute(CityData $data): City
    {
        return City::create([
            'cit_code' => $data->cit_code,
            'cit_name' => $data->cit_name,
            'sta_code' => $data->sta_code,
        ]);
    }
}
