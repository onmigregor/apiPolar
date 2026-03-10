<?php

namespace Modules\CustomerRegion\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\CustomerRegion\Mappers\CustomerRegionMapper;

class CustomerRegionRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = CustomerRegionMapper::class;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cit_code' => ['required', 'string', 'max:2'],
            'cit_name' => ['required', 'string', 'max:20'],
            'sta_code' => ['required', 'string', 'max:3'],
        ];
    }
}
