<?php

namespace Modules\TaxationTax\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaxationTaxResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'ttx_code'          => $this->ttx_code,
            'txn_code'          => $this->txn_code,
            'tax_code'          => $this->tax_code,
            'ttx_date1'         => $this->ttx_date1,
            'pro_code'          => $this->pro_code,
            'ttx_percent_date1' => $this->ttx_percent_date1,
            'unt_code'          => $this->unt_code,
        ];
    }
}
