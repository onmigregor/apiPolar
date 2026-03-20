<?php

namespace Modules\PromotionTeam\Actions;

use Modules\PromotionTeam\Models\PromotionTeam;
use Modules\PromotionTeam\DataTransferObjects\PromotionTeamData;
use Modules\PromotionTeam\Mappers\PromotionTeamMapper;

class StorePromotionTeamAction
{
    public function execute(PromotionTeamData $dto): PromotionTeam
    {
        $data = PromotionTeamMapper::toDatabase($dto);
        return PromotionTeam::updateOrCreate(
            ['tea_code' => $dto->teaCode, 'prm_code' => $dto->prmCode],
            $data
        );
    }
}
