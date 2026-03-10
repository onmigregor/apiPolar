<?php

namespace Modules\Journey\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Journey\Mappers\JourneyMapper;

class JourneyRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = JourneyMapper::class;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'jrn_code'   => ['required', 'string', 'max:10'],
            'rot_code'   => ['required', 'string', 'max:6'],
            'jrn_date'   => ['nullable', 'date'],
            'jrn_dummy'  => ['nullable', 'string', 'max:30'],
            'jrn_status' => ['nullable', 'string', 'max:20'],
        ];
    }
}
