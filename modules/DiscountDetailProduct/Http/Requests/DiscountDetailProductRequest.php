<?php

namespace Modules\DiscountDetailProduct\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\DiscountDetailProduct\Mappers\DiscountDetailProductMapper;

class DiscountDetailProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            DiscountDetailProductMapper::transform($this->all())
        );
    }

    public function rules(): array
    {
        return [
            'dlp_code'                       => ['required', 'string', 'max:10'],
            'dis_code'                       => ['required', 'string', 'max:4'],
            'did_code'                       => ['required', 'string', 'max:10'],
            'pro_code'                       => ['required', 'string', 'max:18'],
            'unt_code'                       => ['required', 'string', 'max:3'],

            'dlp_required'                   => ['nullable', 'string'],
            'dlp_discount'                   => ['nullable', 'numeric'],
            'dlp_discount_percentage'        => ['nullable', 'numeric'],
            'dlp_discount_amount'            => ['nullable', 'numeric'],

            'dlp_required_quantity'          => ['nullable', 'numeric'],
            'dlp_required_quantity_amount'   => ['nullable', 'numeric'],
            'dlp_base_from_taken_for_discou' => ['nullable', 'string'],
            'dlp_pallet_discount'            => ['nullable', 'string'],
            'dlp_minimum'                    => ['nullable', 'numeric'],

            'dlp_quantity1'                  => ['nullable', 'numeric'],
            'dlp_quantity2'                  => ['nullable', 'numeric'],
            'dlp_quantity3'                  => ['nullable', 'numeric'],
            'dlp_quantity4'                  => ['nullable', 'numeric'],
            'dlp_quantity5'                  => ['nullable', 'numeric'],

            'dlp_min_discount1'              => ['nullable', 'numeric'],
            'dlp_min_discount2'              => ['nullable', 'numeric'],
            'dlp_min_discount3'              => ['nullable', 'numeric'],
            'dlp_min_discount4'              => ['nullable', 'numeric'],
            'dlp_min_discount5'              => ['nullable', 'numeric'],

            'dlp_max_discount1'              => ['nullable', 'numeric'],
            'dlp_max_discount2'              => ['nullable', 'numeric'],
            'dlp_max_discount3'              => ['nullable', 'numeric'],
            'dlp_max_discount4'              => ['nullable', 'numeric'],
            'dlp_max_discount5'              => ['nullable', 'numeric'],
            'dlp_max_discount6'              => ['nullable', 'numeric'],

            'dlp_global_discount_amount'     => ['nullable', 'numeric'],
        ];
    }
}
