<?php

namespace Modules\DiscountDetailProduct\Actions;

use Modules\DiscountDetailProduct\DataTransferObjects\DiscountDetailProductData;
use Modules\DiscountDetailProduct\Models\DiscountDetailProduct;

class DiscountDetailProductUpdateAction
{
    public function execute(DiscountDetailProduct $discountDetailProduct, DiscountDetailProductData $data): DiscountDetailProduct
    {
        $discountDetailProduct->update([
            'dlp_code'                       => $data->dlp_code,
            'dis_code'                       => $data->dis_code,
            'did_code'                       => $data->did_code,
            'pro_code'                       => $data->pro_code,
            'unt_code'                       => $data->unt_code,
            'dlp_required'                   => $data->dlp_required,
            'dlp_discount'                   => $data->dlp_discount,
            'dlp_discount_percentage'        => $data->dlp_discount_percentage,
            'dlp_discount_amount'            => $data->dlp_discount_amount,
            'dlp_required_quantity'          => $data->dlp_required_quantity,
            'dlp_required_quantity_amount'   => $data->dlp_required_quantity_amount,
            'dlp_base_from_taken_for_discou' => $data->dlp_base_from_taken_for_discou,
            'dlp_pallet_discount'            => $data->dlp_pallet_discount,
            'dlp_minimum'                    => $data->dlp_minimum,
            'dlp_quantity1'                  => $data->dlp_quantity1,
            'dlp_quantity2'                  => $data->dlp_quantity2,
            'dlp_quantity3'                  => $data->dlp_quantity3,
            'dlp_quantity4'                  => $data->dlp_quantity4,
            'dlp_quantity5'                  => $data->dlp_quantity5,
            'dlp_min_discount1'              => $data->dlp_min_discount1,
            'dlp_min_discount2'              => $data->dlp_min_discount2,
            'dlp_min_discount3'              => $data->dlp_min_discount3,
            'dlp_min_discount4'              => $data->dlp_min_discount4,
            'dlp_min_discount5'              => $data->dlp_min_discount5,
            'dlp_max_discount1'              => $data->dlp_max_discount1,
            'dlp_max_discount2'              => $data->dlp_max_discount2,
            'dlp_max_discount3'              => $data->dlp_max_discount3,
            'dlp_max_discount4'              => $data->dlp_max_discount4,
            'dlp_max_discount5'              => $data->dlp_max_discount5,
            'dlp_max_discount6'              => $data->dlp_max_discount6,
            'dlp_global_discount_amount'     => $data->dlp_global_discount_amount,
        ]);

        return $discountDetailProduct->fresh();
    }
}
