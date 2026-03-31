<?php

namespace Modules\PromotionDetailProduct\Mappers;

use App\Traits\HasMapperTransform;

class PromotionDetailProductMapper
{
    use HasMapperTransform;

    public static array $map = [
        'prp_code'      => ['prpCode', 'prp_code', 'PRPCODE'],
        'pdl_code'      => ['pdlCode', 'pdl_code', 'PDLCODE'],
        'prm_code'      => ['prmCode', 'prm_code', 'PRMCODE'],
        'pro_code'      => ['proCode', 'pro_code', 'PROCODE'],
        'unt_code'      => ['untCode', 'unt_code', 'UNTCODE'],
        'prp_quantity1' => ['prpQuantity1', 'prp_quantity1', 'PRPQUANTITY1'],
    ];
}
