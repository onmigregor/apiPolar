<?php

namespace Modules\Promotion\Mappers;

use Modules\Promotion\DataTransferObjects\PromotionData;

class PromotionMapper
{
    public static function toDatabase(PromotionData $dto): array
    {
        return [
            'prm_code' => $dto->prmCode,
            'prm_name' => $dto->prmName,
        ];
    }
}
