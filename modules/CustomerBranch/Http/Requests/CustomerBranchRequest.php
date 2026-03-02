<?php

namespace Modules\CustomerBranch\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\CustomerBranch\Mappers\CustomerBranchMapper;

class CustomerBranchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            CustomerBranchMapper::transform($this->all())
        );
    }

    public function rules()
    {
        return [
            'tp2_code' => ['required', 'string', 'max:10'],
            'tp2_name' => ['required', 'string', 'max:20'],
        ];
    }
}
