<?php

namespace Modules\DiscountDetailRoute\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\DiscountDetailRoute\Mappers\DiscountDetailRouteMapper;

class DiscountDetailRouteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            DiscountDetailRouteMapper::transform($this->all())
        );
    }

    public function rules(): array
    {
        return [
            'rot_code' => ['required', 'string', 'max:6'],
            'dis_code' => ['required', 'string', 'max:4'],
        ];
    }
}
