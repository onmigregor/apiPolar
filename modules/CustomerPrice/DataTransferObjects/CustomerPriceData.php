<?php

namespace Modules\CustomerPrice\DataTransferObjects;

use Illuminate\Http\Request;

class CustomerPriceData
{
    public function __construct(
        public readonly string $rot_code,
        public readonly string $cus_code,
        public readonly string $prc_code,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            rot_code: $request->validated('rot_code'),
            cus_code: $request->validated('cus_code'),
            prc_code: $request->validated('prc_code'),
        );
    }
}
