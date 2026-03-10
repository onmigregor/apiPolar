<?php

namespace Modules\Tax\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Tax\Mappers\TaxMapper;

class TaxRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = TaxMapper::class;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tax_code' => ['required', 'string', 'max:4'],
            'tax_name' => ['required', 'string', 'max:20'],
        ];
    }
}
