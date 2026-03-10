<?php

namespace Modules\DiscountDetail\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\DiscountDetail\Mappers\DiscountDetailMapper;

class DiscountDetailRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = DiscountDetailMapper::class;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dis_code'          => ['required', 'string', 'max:4'],
            'did_code'          => ['required', 'string', 'max:10'],
            'did_name'          => ['required', 'string', 'max:20'],
            'rot_code_customer' => ['nullable', 'string', 'max:6'],
            'cus_code'          => ['nullable', 'string', 'max:10'],
            'did_since'         => ['nullable', 'date'],
            'did_until'         => ['nullable', 'date'],
        ];
    }
}
