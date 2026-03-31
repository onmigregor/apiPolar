<?php

namespace Modules\CustomerCity\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerCityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'cit_code' => $this->cit_code,
            'cit_name' => $this->cit_name,
            'sta_code' => $this->sta_code,
        ];
    }
}
