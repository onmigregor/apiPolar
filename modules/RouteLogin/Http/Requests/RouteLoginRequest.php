<?php

namespace Modules\RouteLogin\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\RouteLogin\Mappers\RouteLoginMapper;

class RouteLoginRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = RouteLoginMapper::class;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'rot_code' => ['required', 'string', 'max:6'],
            'lgn_code' => ['required', 'string', 'max:6'],
        ];
    }
}
