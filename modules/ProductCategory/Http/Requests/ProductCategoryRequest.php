<?php

namespace Modules\ProductCategory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\ProductCategory\Mappers\ProductCategoryMapper;

class ProductCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            ProductCategoryMapper::transform($this->all())
        );
    }

    public function rules(): array
    {
        return [
            'cl2_code' => ['required', 'string', 'max:18'],
            'cl1_code' => ['required', 'string', 'max:18'],
            'cl2_name' => ['required', 'string', 'max:40'],
        ];
    }
}
