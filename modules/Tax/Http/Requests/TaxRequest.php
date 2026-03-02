<?php

namespace Modules\Tax\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Tax\Mappers\TaxMapper;

class TaxRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            TaxMapper::transform($this->all())
        );
    }

    public function rules(): array
    {
        return [
            'tax_code' => ['required', 'string', 'max:4'],
            'tax_name' => ['required', 'string', 'max:20'],
        ];
    }
}
