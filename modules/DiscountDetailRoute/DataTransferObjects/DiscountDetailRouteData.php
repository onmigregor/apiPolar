<?php

namespace Modules\DiscountDetailRoute\DataTransferObjects;

use Illuminate\Http\Request;

class DiscountDetailRouteData
{
    public function __construct(
        public readonly string $rot_code,
        public readonly string $dis_code,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            rot_code: $request->validated('rot_code'),
            dis_code: $request->validated('dis_code'),
        );
    }
}
