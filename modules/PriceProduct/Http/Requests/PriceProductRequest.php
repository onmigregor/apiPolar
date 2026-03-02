<?php

namespace Modules\PriceProduct\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\PriceProduct\Mappers\PriceProductMapper;

class PriceProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            PriceProductMapper::transform($this->all())
        );
    }

    public function rules(): array
    {
        return [
            'prc_code'         => ['required', 'string', 'max:18'],
            'pro_code'         => ['required', 'string', 'max:18'],
            'unt_code'         => ['required', 'string', 'max:3'],
            'ppr_date1'        => ['required', 'date'],
            'ppr_price1_date1' => ['required', 'numeric'],
        ];
    }
}
