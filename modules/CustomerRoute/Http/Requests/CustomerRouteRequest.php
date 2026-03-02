<?php

namespace Modules\CustomerRoute\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\CustomerRoute\Mappers\CustomerRouteMapper;

class CustomerRouteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            CustomerRouteMapper::transform($this->all())
        );
    }

    public function rules()
    {
        return [
            'rot_code'      => ['required', 'string', 'max:6'],
            'cus_code'      => ['required', 'string', 'max:10'],
            'fre_code'      => ['required', 'string', 'max:2'],
            'ctr_monday'    => ['required', 'string', 'max:1'],
            'ctr_tuesday'   => ['required', 'string', 'max:1'],
            'ctr_wednesday' => ['required', 'string', 'max:1'],
            'ctr_thursday'  => ['required', 'string', 'max:1'],
            'ctr_friday'    => ['required', 'string', 'max:1'],
        ];
    }
}
