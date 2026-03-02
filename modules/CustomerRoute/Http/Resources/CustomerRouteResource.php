<?php

namespace Modules\CustomerRoute\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerRouteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'rot_code'      => $this->rot_code,
            'cus_code'      => $this->cus_code,
            'fre_code'      => $this->fre_code,
            'ctr_monday'    => $this->ctr_monday,
            'ctr_tuesday'   => $this->ctr_tuesday,
            'ctr_wednesday' => $this->ctr_wednesday,
            'ctr_thursday'  => $this->ctr_thursday,
            'ctr_friday'    => $this->ctr_friday,
        ];
    }
}
