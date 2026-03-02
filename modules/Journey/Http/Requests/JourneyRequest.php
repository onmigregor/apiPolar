<?php

namespace Modules\Journey\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Journey\Mappers\JourneyMapper;

class JourneyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            JourneyMapper::transform($this->all())
        );
    }

    public function rules()
    {
        return [
            'jrn_code'   => ['required', 'string', 'max:10'],
            'rot_code'   => ['required', 'string', 'max:6'],
            'jrn_date'   => ['nullable', 'date'],
            'jrn_dummy'  => ['nullable', 'string', 'max:30'],
            'jrn_status' => ['nullable', 'string', 'max:20'],
        ];
    }
}
