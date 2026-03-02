<?php

namespace Modules\CustomerRegion\Actions;

use Modules\CustomerRegion\DataTransferObjects\CustomerRegionData;
use Modules\CustomerRegion\Models\CustomerRegion;

class CustomerRegionUpdateAction
{
    public function execute(CustomerRegion $customerRegion, CustomerRegionData $data): CustomerRegion
    {
        $customerRegion->update([
            'cit_code' => $data->cit_code,
            'cit_name' => $data->cit_name,
            'sta_code' => $data->sta_code,
        ]);
        return $customerRegion->fresh();
    }
}
