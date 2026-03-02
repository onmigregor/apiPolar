<?php

namespace Modules\Product\DataTransferObjects;

use Illuminate\Http\Request;

class ProductData
{
    public function __construct(
        public readonly string $pro_code,
        public readonly string $pro_name,
        public readonly string $pro_short_name,
        public readonly ?string $pro_organization,
        public readonly ?string $unt_code,
        public readonly ?string $pro_bom_code,
        public readonly ?string $cl2_code,
        public readonly ?string $pro_created_on,
        public readonly ?string $pro_modified_on,
        public readonly ?float $pro_weight,
        public readonly ?string $pro_unit_code_bom,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            pro_code:          $request->validated('pro_code'),
            pro_name:          $request->validated('pro_name'),
            pro_short_name:    $request->validated('pro_short_name'),
            pro_organization:  $request->validated('pro_organization'),
            unt_code:          $request->validated('unt_code'),
            pro_bom_code:      $request->validated('pro_bom_code'),
            cl2_code:          $request->validated('cl2_code'),
            pro_created_on:    $request->validated('pro_created_on'),
            pro_modified_on:   $request->validated('pro_modified_on'),
            pro_weight:        $request->validated('pro_weight') !== null ? (float) $request->validated('pro_weight') : null,
            pro_unit_code_bom: $request->validated('pro_unit_code_bom'),
        );
    }
}
