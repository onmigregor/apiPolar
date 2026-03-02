<?php

namespace Modules\Price\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Price\Mappers\PriceMapper;

class PriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            PriceMapper::transform($this->all())
        );
    }

    public function rules(): array
    {
        return [
            'prc_code' => ['required', 'string', 'max:18'],
            'prc_name' => ['required', 'string', 'max:20'],
        ];
    }
}
