<?php

namespace Modules\TaxationTax\Http\Requests;

use App\Traits\HasMapperRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\TaxationTax\Mappers\TaxationTaxMapper;

class TaxationTaxRequest extends FormRequest
{
    use HasMapperRequest;

    protected static string $mapperClass = TaxationTaxMapper::class;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ttx_code'          => ['required', 'string', 'max:18'],
            'txn_code'          => ['required', 'string', 'max:1'],
            'tax_code'          => ['required', 'string', 'max:1'],
            'ttx_date1'         => ['required', 'date'],
            'pro_code'          => ['required', 'string', 'max:18'],
            'ttx_percent_date1' => ['required', 'numeric'],
            'unt_code'          => ['required', 'string', 'max:3'],
        ];
    }
}
