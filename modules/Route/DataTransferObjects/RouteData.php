<?php

namespace Modules\Route\DataTransferObjects;

use Illuminate\Http\Request;

class RouteData
{
    public function __construct(
        public readonly string $rot_code,
        public readonly string $rot_name,
        public readonly string $lgn_code,
        public readonly string $try_code,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            rot_code: $request->validated('rot_code'),
            rot_name: $request->validated('rot_name'),
            lgn_code: $request->validated('lgn_code'),
            try_code: $request->validated('try_code'),
        );
    }
}
