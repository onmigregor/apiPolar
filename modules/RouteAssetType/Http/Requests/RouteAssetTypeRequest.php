<?php

namespace Modules\RouteAssetType\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\RouteAssetType\Mappers\RouteAssetTypeMapper;

class RouteAssetTypeRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = RouteAssetTypeMapper::class;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'rot_code' => ['required', 'string', 'max:6'],
            'att_code' => ['required', 'string', 'max:10'],
        ];
    }
}
