<?php

namespace Modules\Taxation\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaxationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'txn_code' => $this->txn_code,
            'txn_name' => $this->txn_name,
        ];
    }
}
