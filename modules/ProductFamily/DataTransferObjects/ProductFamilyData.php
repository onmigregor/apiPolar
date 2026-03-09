<?php

namespace Modules\ProductFamily\DataTransferObjects;

use Illuminate\Http\Request;

class ProductFamilyData
{
    public function __construct(
        public readonly string $cl1_code,
        public readonly string $cl1_name,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            cl1_code: $request->validated('cl1_code'),
            cl1_name: $request->validated('cl1_name'),
        );
    }
}
