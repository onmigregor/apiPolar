<?php

namespace Modules\Route\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Route\Mappers\RouteMapper;

class RouteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            RouteMapper::transform($this->all())
        );
    }

    public function rules()
    {
        return [
            'rot_code' => ['required', 'string', 'max:6'],
            'rot_name' => ['required', 'string', 'max:30'],
            'lgn_code' => ['required', 'string', 'max:6'],
            'try_code' => ['required', 'string', 'max:10'],
        ];
    }
}
