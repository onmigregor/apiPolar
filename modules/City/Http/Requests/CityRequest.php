<?php

namespace Modules\City\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\City\Mappers\CityMapper;

class CityRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = CityMapper::class;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cit_code' => ['required', 'string', 'max:2'],
            'cit_name' => ['required', 'string', 'max:20'],
            'sta_code' => ['required', 'string', 'max:3'],
        ];
    }
}
