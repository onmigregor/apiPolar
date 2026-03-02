<?php

namespace Modules\CustomerBranch\DataTransferObjects;

use Illuminate\Http\Request;

class CustomerBranchData
{
    public function __construct(
        public readonly string $tp2_code,
        public readonly string $tp2_name,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            tp2_code: $request->validated('tp2_code'),
            tp2_name: $request->validated('tp2_name'),
        );
    }
}
