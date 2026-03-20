<?php

namespace Modules\PromotionDetailProduct\Actions;

use Modules\PromotionDetailProduct\Models\PromotionDetailProduct;
use Modules\PromotionDetailProduct\DataTransferObjects\PromotionDetailProductData;
use Modules\PromotionDetailProduct\Mappers\PromotionDetailProductMapper;

class StorePromotionDetailProductAction
{
    public function execute(PromotionDetailProductData $dto): PromotionDetailProduct
    {
        $data = PromotionDetailProductMapper::toDatabase($dto);
        return PromotionDetailProduct::updateOrCreate(
            ['prp_code' => $dto->prpCode],
            $data
        );
    }
}
