<?php

namespace Modules\CustomerFrequency\Actions;

use Modules\CustomerFrequency\DataTransferObjects\CustomerFrequencyData;
use Modules\CustomerFrequency\Models\CustomerFrequency;

class CustomerFrequencyUpdateAction
{
    public function execute(CustomerFrequency $customerFrequency, CustomerFrequencyData $data): CustomerFrequency
    {
        $customerFrequency->update([
            'fre_code'     => $data->fre_code,
            'fre_name'     => $data->fre_name,
            'fre_week1'    => $data->fre_week1,
            'fre_week2'    => $data->fre_week2,
            'fre_week3'    => $data->fre_week3,
            'fre_week4'    => $data->fre_week4,
            'fre_customer' => $data->fre_customer,
        ]);
        return $customerFrequency->fresh();
    }
}
