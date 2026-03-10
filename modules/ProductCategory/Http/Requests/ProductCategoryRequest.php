<?php

namespace Modules\ProductCategory\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\ProductCategory\Mappers\ProductCategoryMapper;

class ProductCategoryRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = ProductCategoryMapper::class;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cl2_code' => ['required', 'string', 'max:18'],
            'cl1_code' => ['required', 'string', 'max:18'],
            'cl2_name' => ['required', 'string', 'max:40'],
        ];
    }
}
