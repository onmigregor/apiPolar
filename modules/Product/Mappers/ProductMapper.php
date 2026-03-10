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
        'pro_organization'  => ['proOrganization', 'PRO_ORGANIZATION', 'pro_organization'],
        'unt_code'          => ['untCode', 'UNT_CODE', 'unt_code'],
        'pro_bom_code'      => ['proBomCode', 'PRO_BOM_CODE', 'pro_bom_code'],
        'cl2_code'          => ['cl2Code', 'CL2_CODE', 'cl2_code'],
        'pro_created_on'    => ['proCreatedOn', 'PRO_CREATED_ON', 'pro_created_on'],
        'pro_modified_on'   => ['proModifiedOn', 'PRO_MODIFIED_ON', 'pro_modified_on'],
        'pro_weight'        => ['proWeight', 'PRO_WEIGHT', 'pro_weight'],
        'pro_unit_code_bom' => ['proUnitCodeBom', 'PRO_UNIT_CODE_BOM', 'pro_unit_code_bom'],
    ];
}

