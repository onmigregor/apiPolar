<?php

namespace Modules\CustomerGroup\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\CustomerGroup\Mappers\CustomerGroupMapper;

class CustomerGroupRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = CustomerGroupMapper::class;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tp1_code' => ['required', 'string', 'max:3'],
            'tp1_name' => ['required', 'string', 'max:20'],
        ];
    }
}
