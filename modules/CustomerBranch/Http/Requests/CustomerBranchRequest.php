<?php

namespace Modules\CustomerBranch\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\CustomerBranch\Mappers\CustomerBranchMapper;

class CustomerBranchRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = CustomerBranchMapper::class;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tp2_code' => ['required', 'string', 'max:10'],
            'tp2_name' => ['required', 'string', 'max:20'],
        ];
    }
}
