<?php

namespace Modules\Discount\DataTransferObjects;

use Illuminate\Http\Request;

class DiscountData
{
    public function __construct(
        public readonly string $dis_code,
        public readonly string $dis_name,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            dis_code: $request->validated('dis_code'),
            dis_name: $request->validated('dis_name'),
        );
    }
}
