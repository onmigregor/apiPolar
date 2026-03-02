<?php

namespace Modules\RouteGeneral\Actions;

use Modules\RouteGeneral\DataTransferObjects\RouteGeneralData;
use Modules\RouteGeneral\Models\RouteGeneral;

class RouteGeneralUpdateAction
{
    public function execute(RouteGeneral $routeGeneral, RouteGeneralData $data): RouteGeneral
    {
        $routeGeneral->update([
            'rot_code'               => $data->rot_code,
            'gnl_date'               => $data->gnl_date,
            'gnl_month_working_days' => $data->gnl_month_working_days,
            'gnl_days_up_to_date'    => $data->gnl_days_up_to_date,
            'gnl_next_working_day'   => $data->gnl_next_working_day,
            'jrn_code'               => $data->jrn_code,
            'gnl_status'             => $data->gnl_status,
            'gnl_status_date'        => $data->gnl_status_date,
        ]);

        return $routeGeneral->fresh();
    }
}
