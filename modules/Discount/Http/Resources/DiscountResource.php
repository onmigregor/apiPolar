<?php

namespace Modules\Discount\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscountResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'dis_code' => $this->dis_code,
            'dis_name' => $this->dis_name,
        ];
    }
}
