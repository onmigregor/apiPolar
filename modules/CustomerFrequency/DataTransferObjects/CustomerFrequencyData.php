<?php

namespace Modules\CustomerFrequency\DataTransferObjects;

use Illuminate\Http\Request;

class CustomerFrequencyData
{
    public function __construct(
        public readonly string $fre_code,
        public readonly string $fre_name,
        public readonly string $fre_week1,
        public readonly string $fre_week2,
        public readonly string $fre_week3,
        public readonly string $fre_week4,
        public readonly string $fre_customer,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            fre_code:     $request->validated('fre_code'),
            fre_name:     $request->validated('fre_name'),
            fre_week1:    $request->validated('fre_week1'),
            fre_week2:    $request->validated('fre_week2'),
            fre_week3:    $request->validated('fre_week3'),
            fre_week4:    $request->validated('fre_week4'),
            fre_customer: $request->validated('fre_customer'),
        );
    }
}
