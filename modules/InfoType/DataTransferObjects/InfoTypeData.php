<?php

namespace Modules\InfoType\DataTransferObjects;

use Illuminate\Http\Request;

class InfoTypeData
{
    public function __construct(
        public readonly string $ift_code,
        public readonly string $ift_name,
        public readonly string $ift_char_type,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            ift_code:      $request->validated('ift_code'),
            ift_name:      $request->validated('ift_name'),
            ift_char_type: $request->validated('ift_char_type'),
        );
    }
}
