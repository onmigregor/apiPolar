<?php

namespace Modules\DiscountDetailProduct\Mappers;

use App\Traits\HasMapperTransform;

class DiscountDetailProductMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'dlp_code'                       => ['dlpCode', 'DLP_CODE', 'dlp_code'],
        'dis_code'                       => ['disCode', 'DIS_CODE', 'dis_code'],
        'did_code'                       => ['didCode', 'DID_CODE', 'did_code'],
        'pro_code'                       => ['proCode', 'PRO_CODE', 'pro_code'],
        'unt_code'                       => ['untCode', 'UNT_CODE', 'unt_code'],

        'dlp_required'                   => ['dlpRequired', 'DLP_REQUIRED', 'dlp_required'],
        'dlp_discount'                   => ['dlpDiscount', 'DLP_DISCOUNT', 'dlp_discount'],
        'dlp_discount_percentage'        => ['dlpDiscountPercentage', 'DLP_DISCOUNT_PERCENTAGE', 'dlp_discount_percentage'],
        'dlp_discount_amount'            => ['dlpDiscountAmount', 'DLP_DISCOUNT_AMOUNT', 'dlp_discount_amount'],

        'dlp_required_quantity'          => ['dlpRequiredQuantity', 'DLP_REQUIRED_QUANTITY', 'dlp_required_quantity'],
        'dlp_required_quantity_amount'   => ['dlpRequiredQuantityAmount', 'DLP_REQUIRED_QUANTITY_AMOUNT', 'dlp_required_quantity_amount'],
        'dlp_base_from_taken_for_discou' => ['dlpBaseFromTakenForDiscou', 'DLP_BASE_FROM_TAKEN_FOR_DISCOU', 'dlp_base_from_taken_for_discou'],
        'dlp_pallet_discount'            => ['dlpPalletDiscount', 'DLP_PALLET_DISCOUNT', 'dlp_pallet_discount'],
        'dlp_minimum'                    => ['dlpMinimum', 'DLP_MINIMUM', 'dlp_minimum'],

        'dlp_quantity1'                  => ['dlpQuantity1', 'DLP_QUANTITY1', 'dlp_quantity1'],
        'dlp_quantity2'                  => ['dlpQuantity2', 'DLP_QUANTITY2', 'dlp_quantity2'],
        'dlp_quantity3'                  => ['dlpQuantity3', 'DLP_QUANTITY3', 'dlp_quantity3'],
        'dlp_quantity4'                  => ['dlpQuantity4', 'DLP_QUANTITY4', 'dlp_quantity4'],
        'dlp_quantity5'                  => ['dlpQuantity5', 'DLP_QUANTITY5', 'dlp_quantity5'],

        'dlp_min_discount1'              => ['dlpMinDiscount1', 'DLP_MIN_DISCOUNT1', 'dlp_min_discount1'],
        'dlp_min_discount2'              => ['dlpMinDiscount2', 'DLP_MIN_DISCOUNT2', 'dlp_min_discount2'],
        'dlp_min_discount3'              => ['dlpMinDiscount3', 'DLP_MIN_DISCOUNT3', 'dlp_min_discount3'],
        'dlp_min_discount4'              => ['dlpMinDiscount4', 'DLP_MIN_DISCOUNT4', 'dlp_min_discount4'],
        'dlp_min_discount5'              => ['dlpMinDiscount5', 'DLP_MIN_DISCOUNT5', 'dlp_min_discount5'],

        'dlp_max_discount1'              => ['dlpMaxDiscount1', 'DLP_MAX_DISCOUNT1', 'dlp_max_discount1'],
        'dlp_max_discount2'              => ['dlpMaxDiscount2', 'DLP_MAX_DISCOUNT2', 'dlp_max_discount2'],
        'dlp_max_discount3'              => ['dlpMaxDiscount3', 'DLP_MAX_DISCOUNT3', 'dlp_max_discount3'],
        'dlp_max_discount4'              => ['dlpMaxDiscount4', 'DLP_MAX_DISCOUNT4', 'dlp_max_discount4'],
        'dlp_max_discount5'              => ['dlpMaxDiscount5', 'DLP_MAX_DISCOUNT5', 'dlp_max_discount5'],
        'dlp_max_discount6'              => ['dlpMaxDiscount6', 'DLP_MAX_DISCOUNT6', 'dlp_max_discount6'],

        'dlp_global_discount_amount'     => ['dlpGlobalDiscountAmount', 'DLP_GLOBAL_DISCOUNT_AMOUNT', 'dlp_global_discount_amount'],
    ];
}
