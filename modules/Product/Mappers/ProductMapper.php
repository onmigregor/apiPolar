<?php

namespace Modules\Product\Mappers;

use App\Traits\HasMapperTransform;

class ProductMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'pro_code'          => ['proCode', 'PRO_CODE', 'pro_code'],
        'pro_name'          => ['proName', 'PRO_NAME', 'pro_name'],
        'pro_short_name'    => ['proShortName', 'PRO_SHORT_NAME', 'pro_short_name'],
        'pro_barcode'       => ['proBarCode', 'PRO_BARCODE', 'pro_barcode', 'probarcode'],
        'pro_organization'  => ['proOrganization', 'PRO_ORGANIZATION', 'pro_organization', 'proSearchCode', 'proSearchcode'],
        'unt_code'          => ['untCode', 'UNT_CODE', 'unt_code', 'untcode'],
        'pro_bom_code'      => ['proBomCode', 'PRO_BOM_CODE', 'pro_bom_code', 'bomcode'],
        'cl2_code'          => ['cl2Code', 'CL2_CODE', 'cl2_code', 'cl2code'],
        'cl3_code'          => ['cl3Code', 'CL3_CODE', 'cl3_code', 'cl3code'],
        'cl4_code'          => ['cl4Code', 'CL4_CODE', 'cl4_code', 'cl4code'],
        'pro_return_allowed' => ['proReturnAllowed', 'PRO_RETURN_ALLOWED', 'pro_return_allowed', 'proreturnallowed'],
        'pro_damage_returns_allowed' => ['proDamageReturnsAllowed', 'PRO_DAMAGE_RETURNS_ALLOWED', 'pro_damage_returns_allowed', 'prodamagereturnsallowed'],
        'pro_available_for_sale' => ['proAvailableForSale', 'PRO_AVAILABLE_FOR_SALE', 'pro_available_for_sale', 'proavailableforsale'],
        'pro_customer_inventory_allowed' => ['proCustomerInventoryAllowed', 'PRO_CUSTOMER_INVENTORY_ALLOWED', 'pro_customer_inventory_allowed', 'procustomerinventoryallowed'],
        'pro_created_on'    => ['proCreatedOn', 'PRO_CREATED_ON', 'pro_created_on'],
        'pro_modified_on'   => ['proModifiedOn', 'PRO_MODIFIED_ON', 'pro_modified_on'],
        'pro_weight'        => ['proWeight', 'PRO_WEIGHT', 'pro_weight'],
        'pro_unit_code_bom' => ['proUnitCodeBom', 'PRO_UNIT_CODE_BOM', 'pro_unit_code_bom'],
    ];
}

