<?php

namespace Modules\Taxation\DataTransferObjects;

use Illuminate\Http\Request;

class TaxationData
{
    public function __construct(
        public readonly string $txn_code,
        public readonly string $txn_name,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            txn_code: $request->validated('txn_code'),
            txn_name: $request->validated('txn_name'),
        );
    }
}
