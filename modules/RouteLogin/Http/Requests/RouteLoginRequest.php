<?php

namespace Modules\RouteLogin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\RouteLogin\Mappers\RouteLoginMapper;

class RouteLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            RouteLoginMapper::transform($this->all())
        );
    }

    public function rules()
    {
        return [
            'rot_code' => ['required', 'string', 'max:6'],
            'lgn_code' => ['required', 'string', 'max:6'],
        ];
    }
}
