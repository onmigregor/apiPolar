<?php

namespace Modules\Unit\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Unit\Mappers\UnitMapper;

class UnitRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            UnitMapper::transform($this->all())
        );
    }

    public function rules()
    {
        return [
            'unt_code' => ['required', 'string', 'max:3'],
            'unt_name' => ['required', 'string', 'max:10'],
            'unt_nick' => ['required', 'string', 'max:3'],
        ];
    }
}
