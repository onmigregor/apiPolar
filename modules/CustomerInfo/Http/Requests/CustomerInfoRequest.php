<?php

namespace Modules\CustomerInfo\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\CustomerInfo\Mappers\CustomerInfoMapper;

class CustomerInfoRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = CustomerInfoMapper::class;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cus_code'       => ['required', 'string', 'max:10'],
            'ift_code'       => ['required', 'string', 'max:2'],
            'ctn_char_value' => ['required', 'string', 'max:32'],
        ];
    }
}
