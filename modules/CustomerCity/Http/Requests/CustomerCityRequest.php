<?php

namespace Modules\CustomerCity\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\CustomerCity\Mappers\CustomerCityMapper;

class CustomerCityRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = CustomerCityMapper::class;

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
