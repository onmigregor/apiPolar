<?php

namespace Modules\ProductUnit\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductUnitResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'pro_code'      => $this->pro_code,
            'unt_code'      => $this->unt_code,
            'pru_divide_by' => $this->pru_divide_by,
        ];
    }
}
