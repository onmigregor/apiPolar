<?php

namespace Modules\Promotion\Actions;

use Modules\Promotion\Models\Promotion;
use Modules\Promotion\DataTransferObjects\PromotionData;
use Modules\Promotion\Mappers\PromotionMapper;

class StorePromotionAction
{
    public function execute(PromotionData $dto): Promotion
    {
        $data = PromotionMapper::toDatabase($dto);
        return Promotion::updateOrCreate(
            ['prm_code' => $dto->prmCode],
            $data
        );
    }
}
