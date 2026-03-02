<?php

namespace Modules\DiscountDetail\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscountDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'dis_code'          => $this->dis_code,
            'did_code'          => $this->did_code,
            'did_name'          => $this->did_name,
            'rot_code_customer' => $this->rot_code_customer,
            'cus_code'          => $this->cus_code,
            'did_since'         => $this->did_since,
            'did_until'         => $this->did_until,
        ];
    }
}
