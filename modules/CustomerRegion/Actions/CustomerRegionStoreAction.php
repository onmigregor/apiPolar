<?php

namespace Modules\CustomerRegion\Actions;

use Modules\CustomerRegion\DataTransferObjects\CustomerRegionData;
use Modules\CustomerRegion\Models\CustomerRegion;

class CustomerRegionStoreAction
{
    public function execute(CustomerRegionData $data): CustomerRegion
    {
        return CustomerRegion::create([
            'cit_code' => $data->cit_code,
            'cit_name' => $data->cit_name,
            'sta_code' => $data->sta_code,
        ]);
    }
}
