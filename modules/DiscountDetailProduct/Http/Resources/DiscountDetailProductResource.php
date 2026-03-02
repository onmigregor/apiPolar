<?php

namespace Modules\DiscountDetailProduct\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscountDetailProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                             => $this->id,
            'dlp_code'                       => $this->dlp_code,
            'dis_code'                       => $this->dis_code,
            'did_code'                       => $this->did_code,
            'pro_code'                       => $this->pro_code,
            'unt_code'                       => $this->unt_code,

            'dlp_required'                   => $this->dlp_required,
            'dlp_discount'                   => $this->dlp_discount,
            'dlp_discount_percentage'        => $this->dlp_discount_percentage,
            'dlp_discount_amount'            => $this->dlp_discount_amount,

            'dlp_required_quantity'          => $this->dlp_required_quantity,
            'dlp_required_quantity_amount'   => $this->dlp_required_quantity_amount,
            'dlp_base_from_taken_for_discou' => $this->dlp_base_from_taken_for_discou,
            'dlp_pallet_discount'            => $this->dlp_pallet_discount,
            'dlp_minimum'                    => $this->dlp_minimum,

            'dlp_quantity1'                  => $this->dlp_quantity1,
            'dlp_quantity2'                  => $this->dlp_quantity2,
            'dlp_quantity3'                  => $this->dlp_quantity3,
            'dlp_quantity4'                  => $this->dlp_quantity4,
            'dlp_quantity5'                  => $this->dlp_quantity5,

            'dlp_min_discount1'              => $this->dlp_min_discount1,
            'dlp_min_discount2'              => $this->dlp_min_discount2,
            'dlp_min_discount3'              => $this->dlp_min_discount3,
            'dlp_min_discount4'              => $this->dlp_min_discount4,
            'dlp_min_discount5'              => $this->dlp_min_discount5,

            'dlp_max_discount1'              => $this->dlp_max_discount1,
            'dlp_max_discount2'              => $this->dlp_max_discount2,
            'dlp_max_discount3'              => $this->dlp_max_discount3,
            'dlp_max_discount4'              => $this->dlp_max_discount4,
            'dlp_max_discount5'              => $this->dlp_max_discount5,
            'dlp_max_discount6'              => $this->dlp_max_discount6,

            'dlp_global_discount_amount'     => $this->dlp_global_discount_amount,
        ];
    }
}
