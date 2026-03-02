<?php

namespace Modules\ProductUnit\DataTransferObjects;

use Illuminate\Http\Request;

class ProductUnitData
{
    public function __construct(
        public readonly string $pro_code,
        public readonly string $unt_code,
        public readonly string $pru_divide_by,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            pro_code:      $request->validated('pro_code'),
            unt_code:      $request->validated('unt_code'),
            pru_divide_by: $request->validated('pru_divide_by'),
        );
    }
}
