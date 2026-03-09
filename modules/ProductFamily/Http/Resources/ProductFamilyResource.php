<?php

namespace Modules\ProductFamily\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductFamilyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'cl1_code' => $this->cl1_code,
            'cl1_name' => $this->cl1_name,
        ];
    }
}
