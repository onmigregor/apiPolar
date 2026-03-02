<?php

namespace Modules\InfoType\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\InfoType\Mappers\InfoTypeMapper;

class InfoTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            InfoTypeMapper::transform($this->all())
        );
    }

    public function rules()
    {
        return [
            'ift_code'      => ['required', 'string', 'max:2'],
            'ift_name'      => ['required', 'string', 'max:40'],
            'ift_char_type' => ['required', 'string', 'max:2'],
        ];
    }
}
