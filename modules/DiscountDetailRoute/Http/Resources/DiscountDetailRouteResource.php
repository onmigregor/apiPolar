<?php

namespace Modules\DiscountDetailRoute\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscountDetailRouteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'rot_code' => $this->rot_code,
            'dis_code' => $this->dis_code,
        ];
    }
}
