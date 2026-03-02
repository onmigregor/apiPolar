<?php

namespace Modules\Discount\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Discount\Mappers\DiscountMapper;

class DiscountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            DiscountMapper::transform($this->all())
        );
    }

    public function rules(): array
    {
        return [
            'dis_code' => ['required', 'string', 'max:4'],
            'dis_name' => ['required', 'string', 'max:20'],
        ];
    }
}
