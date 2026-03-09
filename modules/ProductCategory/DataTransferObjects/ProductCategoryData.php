<?php

namespace Modules\ProductCategory\DataTransferObjects;

use Illuminate\Http\Request;

class ProductCategoryData
{
    public function __construct(
        public readonly string $cl2_code,
        public readonly string $cl1_code,
        public readonly string $cl2_name,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            cl2_code: $request->validated('cl2_code'),
            cl1_code: $request->validated('cl1_code'),
            cl2_name: $request->validated('cl2_name'),
        );
    }
}
