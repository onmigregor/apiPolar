<?php

namespace Modules\CustomerRoute\DataTransferObjects;

use Illuminate\Http\Request;

class CustomerRouteData
{
    public function __construct(
        public readonly string $rot_code,
        public readonly string $cus_code,
        public readonly string $fre_code,
        public readonly string $ctr_monday,
        public readonly string $ctr_tuesday,
        public readonly string $ctr_wednesday,
        public readonly string $ctr_thursday,
        public readonly string $ctr_friday,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            rot_code:      $request->validated('rot_code'),
            cus_code:      $request->validated('cus_code'),
            fre_code:      $request->validated('fre_code'),
            ctr_monday:    $request->validated('ctr_monday'),
            ctr_tuesday:   $request->validated('ctr_tuesday'),
            ctr_wednesday: $request->validated('ctr_wednesday'),
            ctr_thursday:  $request->validated('ctr_thursday'),
            ctr_friday:    $request->validated('ctr_friday'),
        );
    }
}
