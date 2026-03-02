<?php

namespace Modules\Product\Actions;

use Modules\Product\DataTransferObjects\ProductData;
use Modules\Product\Models\Product;

class ProductUpdateAction
{
    public function execute(Product $product, ProductData $data): Product
    {
        $product->update([
            'pro_code'          => $data->pro_code,
            'pro_name'          => $data->pro_name,
            'pro_short_name'    => $data->pro_short_name,
            'pro_organization'  => $data->pro_organization,
            'unt_code'          => $data->unt_code,
            'pro_bom_code'      => $data->pro_bom_code,
            'cl2_code'          => $data->cl2_code,
            'pro_created_on'    => $data->pro_created_on,
            'pro_modified_on'   => $data->pro_modified_on,
            'pro_weight'        => $data->pro_weight,
            'pro_unit_code_bom' => $data->pro_unit_code_bom,
        ]);

        return $product->fresh();
    }
}
