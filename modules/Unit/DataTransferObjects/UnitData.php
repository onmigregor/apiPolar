<?php

namespace Modules\Unit\DataTransferObjects;

use Illuminate\Http\Request;

class UnitData
{
    public function __construct(
        public readonly string $unt_code,
        public readonly string $unt_name,
        public readonly string $unt_nick,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            unt_code: $request->validated('unt_code'),
            unt_name: $request->validated('unt_name'),
            unt_nick: $request->validated('unt_nick'),
        );
    }
}
