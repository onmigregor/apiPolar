<?php

namespace Modules\ProductCategory\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'cl2_code' => $this->cl2_code,
            'cl1_code' => $this->cl1_code,
            'cl2_name' => $this->cl2_name,
        ];
    }
}
