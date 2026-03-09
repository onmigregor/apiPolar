<?php

namespace Modules\ProductFamily\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\ProductFamily\Mappers\ProductFamilyMapper;

class ProductFamilyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            ProductFamilyMapper::transform($this->all())
        );
    }

    public function rules(): array
    {
        return [
            'cl1_code' => ['required', 'string', 'max:18'],
            'cl1_name' => ['required', 'string', 'max:40'],
        ];
    }
}
