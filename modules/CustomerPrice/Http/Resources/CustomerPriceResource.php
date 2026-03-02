<?php

namespace Modules\CustomerPrice\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerPriceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'rot_code' => $this->rot_code,
            'cus_code' => $this->cus_code,
            'prc_code' => $this->prc_code,
        ];
    }
}
