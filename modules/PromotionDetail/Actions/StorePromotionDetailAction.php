<?php

namespace Modules\PromotionDetail\Actions;

use Modules\PromotionDetail\Models\PromotionDetail;
use Modules\PromotionDetail\DataTransferObjects\PromotionDetailData;
use Modules\PromotionDetail\Mappers\PromotionDetailMapper;

class StorePromotionDetailAction
{
    public function execute(PromotionDetailData $dto): PromotionDetail
    {
        $data = PromotionDetailMapper::toDatabase($dto);
        return PromotionDetail::updateOrCreate(
            ['pdl_code' => $dto->pdlCode],
            $data
        );
    }
}
