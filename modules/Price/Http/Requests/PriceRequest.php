<?php

namespace Modules\Price\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Price\Mappers\PriceMapper;

class PriceRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = PriceMapper::class;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prc_code' => ['required', 'string', 'max:18'],
            'prc_name' => ['required', 'string', 'max:20'],
        ];
    }
}
