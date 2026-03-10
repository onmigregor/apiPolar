<?php

namespace Modules\Route\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Route\Mappers\RouteMapper;

class RouteRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = RouteMapper::class;

    public function authorize()
    {
        return true;
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
