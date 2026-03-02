<?php

namespace Modules\ProductUnit\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\ProductUnit\Mappers\ProductUnitMapper;

class ProductUnitRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            ProductUnitMapper::transform($this->all())
        );
    }

    public function rules()
    {
        return [
            'pro_code'      => ['required', 'string', 'max:18'],
            'unt_code'      => ['required', 'string', 'max:3'],
            'pru_divide_by' => ['required', 'string', 'max:13'],
        ];
    }
}
