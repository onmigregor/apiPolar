<?php

namespace Modules\Customer\DataTransferObjects;

use Illuminate\Http\Request;

class CustomerData
{
    public function __construct(
        public readonly string $cus_code,
        public readonly string $cus_name,
        public readonly string $cus_business_name,
        public readonly string $cus_duns,
        public readonly string $cus_comm_id,
        public readonly string $tp1_code,
        public readonly string $tp2_code,
        public readonly string $cit_code,
        public readonly string $txn_code,
        public readonly string $cus_phone,
        public readonly string $cus_fax,
        public readonly string $cus_street1,
        public readonly string $cus_street2,
        public readonly string $cus_street3,
        public readonly string $cus_tax_id1,
        public readonly string $brc_code,
        public readonly string $cus_latitude,
        public readonly string $cus_longitude,
        public readonly string $prc_code_for_sale,
        public readonly string $prc_code_for_return,
        public readonly string $cus_contact_person,
        public readonly string $cus_email,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            cus_code:            $request->validated('cus_code'),
            cus_name:            $request->validated('cus_name'),
            cus_business_name:   $request->validated('cus_business_name'),
            cus_duns:            $request->validated('cus_duns'),
            cus_comm_id:         $request->validated('cus_comm_id'),
            tp1_code:            $request->validated('tp1_code'),
            tp2_code:            $request->validated('tp2_code'),
            cit_code:            $request->validated('cit_code'),
            txn_code:            $request->validated('txn_code'),
            cus_phone:           $request->validated('cus_phone'),
            cus_fax:             $request->validated('cus_fax'),
            cus_street1:         $request->validated('cus_street1'),
            cus_street2:         $request->validated('cus_street2'),
            cus_street3:         $request->validated('cus_street3'),
            cus_tax_id1:         $request->validated('cus_tax_id1'),
            brc_code:            $request->validated('brc_code'),
            cus_latitude:        $request->validated('cus_latitude'),
            cus_longitude:       $request->validated('cus_longitude'),
            prc_code_for_sale:   $request->validated('prc_code_for_sale'),
            prc_code_for_return: $request->validated('prc_code_for_return'),
            cus_contact_person:  $request->validated('cus_contact_person'),
            cus_email:           $request->validated('cus_email'),
        );
    }
}
