<?php

namespace Modules\Unit\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Unit\Mappers\UnitMapper;

class UnitRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = UnitMapper::class;

    public function authorize()
    {
        return true;
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
