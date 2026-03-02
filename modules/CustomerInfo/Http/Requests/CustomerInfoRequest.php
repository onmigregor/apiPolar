<?php

namespace Modules\CustomerInfo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\CustomerInfo\Mappers\CustomerInfoMapper;

class CustomerInfoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            CustomerInfoMapper::transform($this->all())
        );
    }

    public function rules()
    {
        return [
            'cus_code'       => ['required', 'string', 'max:10'],
            'ift_code'       => ['required', 'string', 'max:2'],
            'ctn_char_value' => ['required', 'string', 'max:32'],
        ];
    }
}
