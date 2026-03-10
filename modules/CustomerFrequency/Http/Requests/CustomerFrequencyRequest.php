<?php

namespace Modules\CustomerFrequency\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\CustomerFrequency\Mappers\CustomerFrequencyMapper;

class CustomerFrequencyRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = CustomerFrequencyMapper::class;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fre_code'     => ['required', 'string', 'max:2'],
            'fre_name'     => ['required', 'string', 'max:40'],
            'fre_week1'    => ['required', 'string', 'max:1'],
            'fre_week2'    => ['required', 'string', 'max:1'],
            'fre_week3'    => ['required', 'string', 'max:1'],
            'fre_week4'    => ['required', 'string', 'max:1'],
            'fre_customer' => ['required', 'string', 'max:1'],
        ];
    }
}
