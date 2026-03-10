<?php

namespace Modules\ProductFamily\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\ProductFamily\Mappers\ProductFamilyMapper;

class ProductFamilyRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = ProductFamilyMapper::class;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cl1_code' => ['required', 'string', 'max:18'],
            'cl1_name' => ['required', 'string', 'max:40'],
        ];
    }
}
