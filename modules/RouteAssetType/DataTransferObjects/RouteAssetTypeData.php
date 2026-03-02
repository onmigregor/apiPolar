<?php

namespace Modules\RouteAssetType\DataTransferObjects;

use Illuminate\Http\Request;

class RouteAssetTypeData
{
    public function __construct(
        public readonly string $rot_code,
        public readonly string $att_code,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            rot_code: $request->validated('rot_code'),
            att_code: $request->validated('att_code'),
        );
    }
}
