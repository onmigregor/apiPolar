<?php

namespace Modules\Price\DataTransferObjects;

use Illuminate\Http\Request;

class PriceData
{
    public function __construct(
        public readonly string $prc_code,
        public readonly string $prc_name,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            prc_code: $request->validated('prc_code'),
            prc_name: $request->validated('prc_name'),
        );
    }
}
