<?php

namespace Modules\DiscountDetail\DataTransferObjects;

use Illuminate\Http\Request;

class DiscountDetailData
{
    public function __construct(
        public readonly string $dis_code,
        public readonly string $did_code,
        public readonly string $did_name,
        public readonly ?string $rot_code_customer,
        public readonly ?string $cus_code,
        public readonly ?string $did_since,
        public readonly ?string $did_until,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            dis_code:          $request->validated('dis_code'),
            did_code:          $request->validated('did_code'),
            did_name:          $request->validated('did_name'),
            rot_code_customer: $request->validated('rot_code_customer'),
            cus_code:          $request->validated('cus_code'),
            did_since:         $request->validated('did_since'),
            did_until:         $request->validated('did_until'),
        );
    }
}
