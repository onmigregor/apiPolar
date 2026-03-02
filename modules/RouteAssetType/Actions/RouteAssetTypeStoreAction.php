<?php

namespace Modules\RouteAssetType\Actions;

use Modules\RouteAssetType\DataTransferObjects\RouteAssetTypeData;
use Modules\RouteAssetType\Models\RouteAssetType;

class RouteAssetTypeStoreAction
{
    public function execute(RouteAssetTypeData $data): RouteAssetType
    {
        return RouteAssetType::create([
            'rot_code' => $data->rot_code,
            'att_code' => $data->att_code,
        ]);
    }
}
