<?php

namespace Modules\CustomerRegion\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\CustomerRegion\Mappers\CustomerRegionMapper;

class CustomerRegionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            CustomerRegionMapper::transform($this->all())
        );
    }

    public function rules()
    {
        return [
            'cit_code' => ['required', 'string', 'max:2'],
            'cit_name' => ['required', 'string', 'max:20'],
            'sta_code' => ['required', 'string', 'max:3'],
        ];
    }
}
