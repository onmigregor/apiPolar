<?php

namespace Modules\CustomerGroup\DataTransferObjects;

use Illuminate\Http\Request;

class CustomerGroupData
{
    public function __construct(
        public readonly string $tp1_code,
        public readonly string $tp1_name,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            tp1_code: $request->validated('tp1_code'),
            tp1_name: $request->validated('tp1_name'),
        );
    }
}
