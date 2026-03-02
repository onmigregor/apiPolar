<?php

namespace Modules\CustomerPrice\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\CustomerPrice\Mappers\CustomerPriceMapper;

class CustomerPriceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            CustomerPriceMapper::transform($this->all())
        );
    }

    public function rules()
    {
        return [
            'rot_code' => ['required', 'string', 'max:6'],
            'cus_code' => ['required', 'string', 'max:10'],
            'prc_code' => ['required', 'string', 'max:4'],
        ];
    }
}
