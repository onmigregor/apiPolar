<?php

namespace Modules\Customer\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->id,
            'cus_code'            => $this->cus_code,
            'cus_name'            => $this->cus_name,
            'cus_business_name'   => $this->cus_business_name,
            'cus_duns'            => $this->cus_duns,
            'cus_comm_id'         => $this->cus_comm_id,
            'tp1_code'            => $this->tp1_code,
            'tp2_code'            => $this->tp2_code,
            'cit_code'            => $this->cit_code,
            'txn_code'            => $this->txn_code,
            'cus_phone'           => $this->cus_phone,
            'cus_fax'             => $this->cus_fax,
            'cus_street1'         => $this->cus_street1,
            'cus_street2'         => $this->cus_street2,
            'cus_street3'         => $this->cus_street3,
            'cus_tax_id1'         => $this->cus_tax_id1,
            'brc_code'            => $this->brc_code,
            'cus_latitude'        => $this->cus_latitude,
            'cus_longitude'       => $this->cus_longitude,
            'prc_code_for_sale'   => $this->prc_code_for_sale,
            'prc_code_for_return' => $this->prc_code_for_return,
            'cus_contact_person'  => $this->cus_contact_person,
            'cus_email'           => $this->cus_email,
        ];
    }
}
