<?php

namespace Modules\Customer\Mappers;

use App\Traits\HasMapperTransform;

class CustomerMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'cus_code'            => ['cusCode', 'CUS_CODE', 'cus_code'],
        'cus_name'            => ['cusName', 'CUS_NAME', 'cus_name'],
        'cus_business_name'   => ['cusBusinessName', 'CUS_BUSINESS_NAME', 'cus_business_name'],
        'cus_duns'            => ['cusDuns', 'CUS_DUNS', 'cus_duns'],
        'cus_comm_id'         => ['cusCommId', 'CUS_COMM_ID', 'cus_comm_id'],
        'tp1_code'            => ['tp1Code', 'TP1_CODE', 'tp1_code'],
        'tp2_code'            => ['tp2Code', 'TP2_CODE', 'tp2_code'],
        'tp3_code'            => ['tp3Code', 'TP3_CODE', 'tp3_code'],
        'cit_code'            => ['citCode', 'CIT_CODE', 'cit_code'],
        'txn_code'            => ['txnCode', 'TXN_CODE', 'txn_code'],
        'cus_phone'           => ['cusPhone', 'CUS_PHONE', 'cus_phone'],
        'cus_fax'             => ['cusFax', 'CUS_FAX', 'cus_fax'],
        'cus_street1'         => ['cusStreet1', 'CUS_STREET1', 'cus_street1'],
        'cus_street2'         => ['cusStreet2', 'CUS_STREET2', 'cus_street2'],
        'cus_street3'         => ['cusStreet3', 'CUS_STREET3', 'cus_street3'],
        'cus_tax_id1'         => ['cusTaxID1', 'CUS_TAX_ID1', 'cus_tax_id1'],
        'brc_code'            => ['brcCode', 'BRC_CODE', 'brc_code'],
        'cus_latitude'        => ['cusLatitude', 'CUS_LATITUDE', 'cus_latitude'],
        'cus_longitude'       => ['cusLongitude', 'CUS_LONGITUDE', 'cus_longitude'],
        'prc_code_for_sale'   => ['prcCodeForSale', 'PRC_CODE_FOR_SALE', 'prc_code_for_sale'],
        'prc_code_for_return' => ['prcCodeForReturn', 'PRC_CODE_FOR_RETURN', 'prc_code_for_return'],
        'cus_contact_person'  => ['cusContactPerson', 'CUS_CONTACT_PERSON', 'cus_contact_person'],
        'cus_email'           => ['cusEmail', 'CUS_EMAIL', 'cus_email'],
        'cus_administrator'   => ['cusAdministrator', 'CUS_ADMINISTRATOR', 'cus_administrator'],
    ];
}
