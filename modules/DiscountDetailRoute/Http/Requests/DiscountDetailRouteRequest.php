<?php

namespace Modules\DiscountDetailRoute\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\DiscountDetailRoute\Mappers\DiscountDetailRouteMapper;

class DiscountDetailRouteRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = DiscountDetailRouteMapper::class;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'rot_code' => ['required', 'string', 'max:6'],
            'dis_code' => ['required', 'string', 'max:4'],
        ];
    }
}
