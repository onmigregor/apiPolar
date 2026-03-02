<?php

namespace Modules\RouteAssetType\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\RouteAssetType\Mappers\RouteAssetTypeMapper;

class RouteAssetTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            RouteAssetTypeMapper::transform($this->all())
        );
    }

    public function rules()
    {
        return [
            'rot_code' => ['required', 'string', 'max:6'],
            'att_code' => ['required', 'string', 'max:10'],
        ];
    }
}
