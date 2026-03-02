<?php

namespace Modules\Journey\DataTransferObjects;

use Illuminate\Http\Request;

class JourneyData
{
    public function __construct(
        public readonly string $jrn_code,
        public readonly string $rot_code,
        public readonly ?string $jrn_date,
        public readonly ?string $jrn_dummy,
        public readonly ?string $jrn_status,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            jrn_code:   $request->validated('jrn_code'),
            rot_code:   $request->validated('rot_code'),
            jrn_date:   $request->validated('jrn_date'),
            jrn_dummy:  $request->validated('jrn_dummy'),
            jrn_status: $request->validated('jrn_status'),
        );
    }
}
