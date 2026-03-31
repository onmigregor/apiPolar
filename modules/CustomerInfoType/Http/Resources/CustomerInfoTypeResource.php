<?php

namespace Modules\CustomerInfoType\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerInfoTypeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'ift_code'      => $this->ift_code,
            'ift_name'      => $this->ift_name,
            'ift_char_type' => $this->ift_char_type,
        ];
    }
}
