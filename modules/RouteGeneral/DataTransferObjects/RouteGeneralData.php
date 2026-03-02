<?php

namespace Modules\RouteGeneral\DataTransferObjects;

use Illuminate\Http\Request;

class RouteGeneralData
{
    public function __construct(
        public readonly string $rot_code,
        public readonly ?string $gnl_date,
        public readonly ?int $gnl_month_working_days,
        public readonly ?int $gnl_days_up_to_date,
        public readonly ?string $gnl_next_working_day,
        public readonly ?string $jrn_code,
        public readonly ?string $gnl_status,
        public readonly ?string $gnl_status_date,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            rot_code:               $request->validated('rot_code'),
            gnl_date:               $request->validated('gnl_date'),
            gnl_month_working_days: $request->validated('gnl_month_working_days'),
            gnl_days_up_to_date:    $request->validated('gnl_days_up_to_date'),
            gnl_next_working_day:   $request->validated('gnl_next_working_day'),
            jrn_code:               $request->validated('jrn_code'),
            gnl_status:             $request->validated('gnl_status'),
            gnl_status_date:        $request->validated('gnl_status_date'),
        );
    }
}
