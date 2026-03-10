<?php

namespace Modules\ProductUnit\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\ProductUnit\Mappers\ProductUnitMapper;

class ProductUnitRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = ProductUnitMapper::class;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'pro_code'      => ['required', 'string', 'max:18'],
            'unt_code'      => ['required', 'string', 'max:3'],
            'pru_divide_by' => ['required', 'string', 'max:13'],
        ];
    }
}
