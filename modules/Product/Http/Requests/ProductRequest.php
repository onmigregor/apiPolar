<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Product\Mappers\ProductMapper;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            ProductMapper::transform($this->all())
        );
    }

    public function rules()
    {
        return [
            'pro_code'          => ['required', 'string', 'max:18'],
            'pro_name'          => ['required', 'string', 'max:40'],
            'pro_short_name'    => ['required', 'string', 'max:40'],
            'pro_organization'  => ['nullable', 'string', 'max:4'],
            'unt_code'          => ['nullable', 'string', 'max:3'],
            'pro_bom_code'      => ['nullable', 'string', 'max:18'],
            'cl2_code'          => ['nullable', 'string', 'max:18'],
            'pro_created_on'    => ['nullable', 'date'],
            'pro_modified_on'   => ['nullable', 'date'],
            'pro_weight'        => ['nullable', 'numeric'],
            'pro_unit_code_bom' => ['nullable', 'string', 'max:3'],
        ];
    }
}
