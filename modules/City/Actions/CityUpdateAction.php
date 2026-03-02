<?php

namespace Modules\City\Actions;

use Modules\City\DataTransferObjects\CityData;
use Modules\City\Models\City;

class CityUpdateAction
{
    public function execute(City $city, CityData $data): City
    {
        $city->update([
            'cit_code' => $data->cit_code,
            'cit_name' => $data->cit_name,
            'sta_code' => $data->sta_code,
        ]);

        return $city->fresh();
    }
}
