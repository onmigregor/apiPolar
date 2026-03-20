<?php

namespace Modules\PromotionDetail\Mappers;

use Modules\PromotionDetail\DataTransferObjects\PromotionDetailData;

class PromotionDetailMapper
{
    public static function toDatabase(PromotionDetailData $dto): array
    {
        return [
            'pdl_code' => $dto->pdlCode,
            'prm_code' => $dto->prmCode,
            'pdl_name' => $dto->pdlName,
            'pdl_since' => $dto->pdlSince,
            'pdl_until' => $dto->pdlUntil ? str_replace('T', ' ', $dto->pdlUntil) : null,
            'cus_code' => $dto->cusCode,
        ];
    }
}
