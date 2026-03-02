<?php

namespace Modules\Customer\Actions;

use Modules\Customer\DataTransferObjects\CustomerData;
use Modules\Customer\Models\Customer;

class CustomerUpdateAction
{
    public function execute(Customer $customer, CustomerData $data): Customer
    {
        $customer->update([
            'cus_code'            => $data->cus_code,
            'cus_name'            => $data->cus_name,
            'cus_business_name'   => $data->cus_business_name,
            'cus_duns'            => $data->cus_duns,
            'cus_comm_id'         => $data->cus_comm_id,
            'tp1_code'            => $data->tp1_code,
            'tp2_code'            => $data->tp2_code,
            'cit_code'            => $data->cit_code,
            'txn_code'            => $data->txn_code,
            'cus_phone'           => $data->cus_phone,
            'cus_fax'             => $data->cus_fax,
            'cus_street1'         => $data->cus_street1,
            'cus_street2'         => $data->cus_street2,
            'cus_street3'         => $data->cus_street3,
            'cus_tax_id1'         => $data->cus_tax_id1,
            'brc_code'            => $data->brc_code,
            'cus_latitude'        => $data->cus_latitude,
            'cus_longitude'       => $data->cus_longitude,
            'prc_code_for_sale'   => $data->prc_code_for_sale,
            'prc_code_for_return' => $data->prc_code_for_return,
            'cus_contact_person'  => $data->cus_contact_person,
            'cus_email'           => $data->cus_email,
        ]);

        return $customer->fresh();
    }
}
