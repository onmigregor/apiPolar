<?php

namespace Modules\PromotionDetailProduct\Mappers;

use Modules\PromotionDetailProduct\DataTransferObjects\PromotionDetailProductData;

class PromotionDetailProductMapper
{
    public static function toDatabase(PromotionDetailProductData $dto): array
    {
        return [
            'prp_code' => $dto->prpCode,
            'pdl_code' => $dto->pdlCode,
            'prm_code' => $dto->prmCode,
            'pro_code' => $dto->proCode,
            'unt_code' => $dto->untCode,
            'prp_quantity1' => $dto->prpQuantity1,
        ];
    }
}
