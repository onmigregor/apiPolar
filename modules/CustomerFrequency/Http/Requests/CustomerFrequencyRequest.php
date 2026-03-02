<?php

namespace Modules\CustomerFrequency\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\CustomerFrequency\Mappers\CustomerFrequencyMapper;

class CustomerFrequencyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            CustomerFrequencyMapper::transform($this->all())
        );
    }

    public function rules()
    {
        return [
            'fre_code'     => ['required', 'string', 'max:2'],
            'fre_name'     => ['required', 'string', 'max:40'],
            'fre_week1'    => ['required', 'string', 'max:1'],
            'fre_week2'    => ['required', 'string', 'max:1'],
            'fre_week3'    => ['required', 'string', 'max:1'],
            'fre_week4'    => ['required', 'string', 'max:1'],
            'fre_customer' => ['required', 'string', 'max:1'],
        ];
    }
}
