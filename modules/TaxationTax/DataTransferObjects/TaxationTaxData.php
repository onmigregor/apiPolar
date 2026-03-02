<?php

namespace Modules\TaxationTax\DataTransferObjects;

use Illuminate\Http\Request;

class TaxationTaxData
{
    public function __construct(
        public readonly string $ttx_code,
        public readonly string $txn_code,
        public readonly string $tax_code,
        public readonly string $ttx_date1,
        public readonly string $pro_code,
        public readonly float $ttx_percent_date1,
        public readonly string $unt_code,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            ttx_code:          $request->validated('ttx_code'),
            txn_code:          $request->validated('txn_code'),
            tax_code:          $request->validated('tax_code'),
            ttx_date1:         $request->validated('ttx_date1'),
            pro_code:          $request->validated('pro_code'),
            ttx_percent_date1: (float) $request->validated('ttx_percent_date1'),
            unt_code:          $request->validated('unt_code'),
        );
    }
}
