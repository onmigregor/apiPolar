<?php

namespace Modules\Customer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Customer\Mappers\CustomerMapper;

class CustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            CustomerMapper::transform($this->all())
        );
    }

    public function rules()
    {
        return [
            'cus_code'            => ['required', 'string', 'max:10'],
            'cus_name'            => ['required', 'string', 'max:35'],
            'cus_business_name'   => ['nullable', 'string', 'max:35'],
            'cus_duns'            => ['nullable', 'string', 'max:40'],
            'cus_comm_id'         => ['nullable', 'string', 'max:40'],
            'tp1_code'            => ['required', 'string', 'max:3'],
            'tp2_code'            => ['required', 'string', 'max:10'],
            'cit_code'            => ['required', 'string', 'max:2'],
            'txn_code'            => ['required', 'string', 'max:2'],
            'cus_phone'           => ['nullable', 'string', 'max:16'],
            'cus_fax'             => ['nullable', 'string', 'max:16'],
            'cus_street1'         => ['nullable', 'string', 'max:40'],
            'cus_street2'         => ['nullable', 'string', 'max:40'],
            'cus_street3'         => ['nullable', 'string', 'max:40'],
            'cus_tax_id1'         => ['required', 'string', 'max:16'],
            'brc_code'            => ['required', 'string', 'max:10'],
            'cus_latitude'        => ['nullable', 'string', 'max:40'],
            'cus_longitude'       => ['nullable', 'string', 'max:40'],
            'prc_code_for_sale'   => ['required', 'string', 'max:4'],
            'prc_code_for_return' => ['required', 'string', 'max:4'],
            'cus_contact_person'  => ['nullable', 'string', 'max:35'],
            'cus_email'           => ['nullable', 'string', 'max:241'],
        ];
    }
}
