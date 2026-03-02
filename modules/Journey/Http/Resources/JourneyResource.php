<?php

namespace Modules\Journey\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JourneyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'jrn_code'   => $this->jrn_code,
            'rot_code'   => $this->rot_code,
            'jrn_date'   => $this->jrn_date,
            'jrn_dummy'  => $this->jrn_dummy,
            'jrn_status' => $this->jrn_status,
        ];
    }
}
