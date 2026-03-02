<?php

namespace Modules\CustomerFrequency\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerFrequencyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'fre_code'     => $this->fre_code,
            'fre_name'     => $this->fre_name,
            'fre_week1'    => $this->fre_week1,
            'fre_week2'    => $this->fre_week2,
            'fre_week3'    => $this->fre_week3,
            'fre_week4'    => $this->fre_week4,
            'fre_customer' => $this->fre_customer,
        ];
    }
}
