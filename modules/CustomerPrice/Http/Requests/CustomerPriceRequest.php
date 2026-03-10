<?php

namespace Modules\CustomerPrice\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\CustomerPrice\Mappers\CustomerPriceMapper;

class CustomerPriceRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = CustomerPriceMapper::class;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'rot_code' => ['required', 'string', 'max:6'],
            'cus_code' => ['required', 'string', 'max:10'],
            'prc_code' => ['required', 'string', 'max:4'],
        ];
    }
}
