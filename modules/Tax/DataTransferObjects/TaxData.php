<?php

namespace Modules\Tax\DataTransferObjects;

use Illuminate\Http\Request;

class TaxData
{
    public function __construct(
        public readonly string $tax_code,
        public readonly string $tax_name,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            tax_code: $request->validated('tax_code'),
            tax_name: $request->validated('tax_name'),
        );
    }
}
