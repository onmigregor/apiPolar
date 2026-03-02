<?php

namespace Modules\DiscountDetailProduct\DataTransferObjects;

use Illuminate\Http\Request;

class DiscountDetailProductData
{
    public function __construct(
        public readonly string $dlp_code,
        public readonly string $dis_code,
        public readonly string $did_code,
        public readonly string $pro_code,
        public readonly string $unt_code,

        public readonly ?string $dlp_required,
        public readonly ?float $dlp_discount,
        public readonly ?float $dlp_discount_percentage,
        public readonly ?float $dlp_discount_amount,

        public readonly ?float $dlp_required_quantity,
        public readonly ?float $dlp_required_quantity_amount,
        public readonly ?string $dlp_base_from_taken_for_discou,
        public readonly ?string $dlp_pallet_discount,
        public readonly ?float $dlp_minimum,

        public readonly ?float $dlp_quantity1,
        public readonly ?float $dlp_quantity2,
        public readonly ?float $dlp_quantity3,
        public readonly ?float $dlp_quantity4,
        public readonly ?float $dlp_quantity5,

        public readonly ?float $dlp_min_discount1,
        public readonly ?float $dlp_min_discount2,
        public readonly ?float $dlp_min_discount3,
        public readonly ?float $dlp_min_discount4,
        public readonly ?float $dlp_min_discount5,

        public readonly ?float $dlp_max_discount1,
        public readonly ?float $dlp_max_discount2,
        public readonly ?float $dlp_max_discount3,
        public readonly ?float $dlp_max_discount4,
        public readonly ?float $dlp_max_discount5,
        public readonly ?float $dlp_max_discount6,

        public readonly ?float $dlp_global_discount_amount,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            dlp_code:                       $request->validated('dlp_code'),
            dis_code:                       $request->validated('dis_code'),
            did_code:                       $request->validated('did_code'),
            pro_code:                       $request->validated('pro_code'),
            unt_code:                       $request->validated('unt_code'),

            dlp_required:                   $request->validated('dlp_required'),
            dlp_discount:                   $request->validated('dlp_discount') ? (float) $request->validated('dlp_discount') : null,
            dlp_discount_percentage:        $request->validated('dlp_discount_percentage') ? (float) $request->validated('dlp_discount_percentage') : null,
            dlp_discount_amount:            $request->validated('dlp_discount_amount') ? (float) $request->validated('dlp_discount_amount') : null,

            dlp_required_quantity:          $request->validated('dlp_required_quantity') ? (float) $request->validated('dlp_required_quantity') : null,
            dlp_required_quantity_amount:   $request->validated('dlp_required_quantity_amount') ? (float) $request->validated('dlp_required_quantity_amount') : null,
            dlp_base_from_taken_for_discou: $request->validated('dlp_base_from_taken_for_discou'),
            dlp_pallet_discount:            $request->validated('dlp_pallet_discount'),
            dlp_minimum:                    $request->validated('dlp_minimum') ? (float) $request->validated('dlp_minimum') : null,

            dlp_quantity1:                  $request->validated('dlp_quantity1') ? (float) $request->validated('dlp_quantity1') : null,
            dlp_quantity2:                  $request->validated('dlp_quantity2') ? (float) $request->validated('dlp_quantity2') : null,
            dlp_quantity3:                  $request->validated('dlp_quantity3') ? (float) $request->validated('dlp_quantity3') : null,
            dlp_quantity4:                  $request->validated('dlp_quantity4') ? (float) $request->validated('dlp_quantity4') : null,
            dlp_quantity5:                  $request->validated('dlp_quantity5') ? (float) $request->validated('dlp_quantity5') : null,

            dlp_min_discount1:              $request->validated('dlp_min_discount1') ? (float) $request->validated('dlp_min_discount1') : null,
            dlp_min_discount2:              $request->validated('dlp_min_discount2') ? (float) $request->validated('dlp_min_discount2') : null,
            dlp_min_discount3:              $request->validated('dlp_min_discount3') ? (float) $request->validated('dlp_min_discount3') : null,
            dlp_min_discount4:              $request->validated('dlp_min_discount4') ? (float) $request->validated('dlp_min_discount4') : null,
            dlp_min_discount5:              $request->validated('dlp_min_discount5') ? (float) $request->validated('dlp_min_discount5') : null,

            dlp_max_discount1:              $request->validated('dlp_max_discount1') ? (float) $request->validated('dlp_max_discount1') : null,
            dlp_max_discount2:              $request->validated('dlp_max_discount2') ? (float) $request->validated('dlp_max_discount2') : null,
            dlp_max_discount3:              $request->validated('dlp_max_discount3') ? (float) $request->validated('dlp_max_discount3') : null,
            dlp_max_discount4:              $request->validated('dlp_max_discount4') ? (float) $request->validated('dlp_max_discount4') : null,
            dlp_max_discount5:              $request->validated('dlp_max_discount5') ? (float) $request->validated('dlp_max_discount5') : null,
            dlp_max_discount6:              $request->validated('dlp_max_discount6') ? (float) $request->validated('dlp_max_discount6') : null,

            dlp_global_discount_amount:     $request->validated('dlp_global_discount_amount') ? (float) $request->validated('dlp_global_discount_amount') : null,
        );
    }
}
