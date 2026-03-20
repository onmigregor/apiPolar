<?php

namespace Modules\PromotionTeam\Mappers;

use Modules\PromotionTeam\DataTransferObjects\PromotionTeamData;

class PromotionTeamMapper
{
    public static function toDatabase(PromotionTeamData $dto): array
    {
        return [
            'tea_code' => $dto->teaCode,
            'prm_code' => $dto->prmCode,
        ];
    }
}
