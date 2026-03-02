<?php

namespace Modules\City\Actions;

use Modules\City\Models\City;

class CityDeleteAction
{
    public function execute(City $city): void
    {
        $city->delete();
    }
}
