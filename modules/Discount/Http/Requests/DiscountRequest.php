<?php

namespace Modules\Discount\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Discount\Mappers\DiscountMapper;

class DiscountRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = DiscountMapper::class;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dis_code' => ['required', 'string', 'max:4'],
            'dis_name' => ['required', 'string', 'max:20'],
        ];
    }
}
