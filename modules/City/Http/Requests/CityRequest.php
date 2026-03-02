<?php

namespace Modules\City\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\City\Mappers\CityMapper;

class CityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            CityMapper::transform($this->all())
        );
    }

    public function rules(): array
    {
        return [
            'cit_code' => ['required', 'string', 'max:2'],
            'cit_name' => ['required', 'string', 'max:20'],
            'sta_code' => ['required', 'string', 'max:3'],
        ];
    }
}
