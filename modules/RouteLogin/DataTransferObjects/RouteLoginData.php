<?php

namespace Modules\RouteLogin\DataTransferObjects;

use Illuminate\Http\Request;

class RouteLoginData
{
    public function __construct(
        public readonly string $rot_code,
        public readonly string $lgn_code,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            rot_code: $request->validated('rot_code'),
            lgn_code: $request->validated('lgn_code'),
        );
    }
}
