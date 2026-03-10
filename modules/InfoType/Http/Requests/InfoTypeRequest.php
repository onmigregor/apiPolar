<?php

namespace Modules\InfoType\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\InfoType\Mappers\InfoTypeMapper;

class InfoTypeRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = InfoTypeMapper::class;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ift_code'      => ['required', 'string', 'max:2'],
            'ift_name'      => ['required', 'string', 'max:40'],
            'ift_char_type' => ['required', 'string', 'max:2'],
        ];
    }
}
