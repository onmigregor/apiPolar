<?php

namespace Modules\Price\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PriceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'prc_code' => $this->prc_code,
            'prc_name' => $this->prc_name,
        ];
    }
}
