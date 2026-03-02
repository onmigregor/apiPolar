<?php

namespace Modules\CustomerInfo\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerInfoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'cus_code'       => $this->cus_code,
            'ift_code'       => $this->ift_code,
            'ctn_char_value' => $this->ctn_char_value,
        ];
    }
}
