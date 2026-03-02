<?php

namespace Modules\CustomerGroup\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\CustomerGroup\Mappers\CustomerGroupMapper;

class CustomerGroupRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Transforma las llaves camelCase a snake_case antes de validar.
     */
    protected function prepareForValidation(): void
    {
        $this->merge(
            CustomerGroupMapper::transform($this->all())
        );
    }

    public function rules()
    {
        return [
            'tp1_code' => ['required', 'string', 'max:3'],
            'tp1_name' => ['required', 'string', 'max:20'],
        ];
    }
}
