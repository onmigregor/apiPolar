<?php

namespace Modules\Journey\Actions;

use Modules\Journey\DataTransferObjects\JourneyData;
use Modules\Journey\Models\Journey;

class JourneyStoreAction
{
    public function execute(JourneyData $data): Journey
    {
        return Journey::create([
            'jrn_code'   => $data->jrn_code,
            'rot_code'   => $data->rot_code,
            'jrn_date'   => $data->jrn_date,
            'jrn_dummy'  => $data->jrn_dummy,
            'jrn_status' => $data->jrn_status,
        ]);
    }
}
