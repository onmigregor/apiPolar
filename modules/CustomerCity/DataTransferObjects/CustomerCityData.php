<?php

namespace Modules\CustomerCity\DataTransferObjects;

use Illuminate\Http\Request;

class CustomerCityData
{
    public function __construct(
        public readonly string $cit_code,
        public readonly string $cit_name,
        public readonly string $sta_code,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            cit_code: $request->validated('cit_code'),
            cit_name: $request->validated('cit_name'),
            sta_code: $request->validated('sta_code'),
        );
    }
}
