<?php

namespace Modules\Product\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'pro_code'          => $this->pro_code,
            'pro_name'          => $this->pro_name,
            'pro_short_name'    => $this->pro_short_name,
            'pro_organization'  => $this->pro_organization,
            'unt_code'          => $this->unt_code,
            'pro_bom_code'      => $this->pro_bom_code,
            'cl2_code'          => $this->cl2_code,
            'pro_created_on'    => $this->pro_created_on,
            'pro_modified_on'   => $this->pro_modified_on,
            'pro_weight'        => $this->pro_weight,
            'pro_unit_code_bom' => $this->pro_unit_code_bom,
        ];
    }
}
