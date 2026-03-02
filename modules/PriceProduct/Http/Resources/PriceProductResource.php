<?php

namespace Modules\PriceProduct\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PriceProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'prc_code'         => $this->prc_code,
            'pro_code'         => $this->pro_code,
            'unt_code'         => $this->unt_code,
            'ppr_date1'        => $this->ppr_date1,
            'ppr_price1_date1' => $this->ppr_price1_date1,
        ];
    }
}
