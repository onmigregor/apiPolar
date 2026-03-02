<?php

namespace Modules\PriceProduct\DataTransferObjects;

use Illuminate\Http\Request;

class PriceProductData
{
    public function __construct(
        public readonly string $prc_code,
        public readonly string $pro_code,
        public readonly string $unt_code,
        public readonly string $ppr_date1,
        public readonly float $ppr_price1_date1,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            prc_code:         $request->validated('prc_code'),
            pro_code:         $request->validated('pro_code'),
            unt_code:         $request->validated('unt_code'),
            ppr_date1:        $request->validated('ppr_date1'),
            ppr_price1_date1: (float) $request->validated('ppr_price1_date1'),
        );
    }
}
