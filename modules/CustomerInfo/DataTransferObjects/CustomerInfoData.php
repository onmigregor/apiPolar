<?php

namespace Modules\CustomerInfo\DataTransferObjects;

use Illuminate\Http\Request;

class CustomerInfoData
{
    public function __construct(
        public readonly string $cus_code,
        public readonly string $ift_code,
        public readonly string $ctn_char_value,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            cus_code:       $request->validated('cus_code'),
            ift_code:       $request->validated('ift_code'),
            ctn_char_value: $request->validated('ctn_char_value'),
        );
    }
}
