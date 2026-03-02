<?php

namespace Modules\RouteGeneral\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RouteGeneralResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                     => $this->id,
            'rot_code'               => $this->rot_code,
            'gnl_date'               => $this->gnl_date,
            'gnl_month_working_days' => $this->gnl_month_working_days,
            'gnl_days_up_to_date'    => $this->gnl_days_up_to_date,
            'gnl_next_working_day'   => $this->gnl_next_working_day,
            'jrn_code'               => $this->jrn_code,
            'gnl_status'             => $this->gnl_status,
            'gnl_status_date'        => $this->gnl_status_date,
        ];
    }
}
