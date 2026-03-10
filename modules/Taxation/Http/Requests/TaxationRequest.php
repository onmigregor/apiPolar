<?php

namespace Modules\Taxation\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Taxation\Mappers\TaxationMapper;

class TaxationRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = TaxationMapper::class;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'txn_code' => ['required', 'string', 'max:5'],
            'txn_name' => ['required', 'string', 'max:20'],
        ];
    }
}
