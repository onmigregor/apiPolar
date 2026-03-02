<?php

namespace Modules\Taxation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Taxation\Mappers\TaxationMapper;

class TaxationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            TaxationMapper::transform($this->all())
        );
    }

    public function rules(): array
    {
        return [
            'txn_code' => ['required', 'string', 'max:5'],
            'txn_name' => ['required', 'string', 'max:20'],
        ];
    }
}
