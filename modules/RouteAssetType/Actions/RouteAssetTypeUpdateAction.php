<?php

namespace Modules\RouteAssetType\Actions;

use Modules\RouteAssetType\DataTransferObjects\RouteAssetTypeData;
use Modules\RouteAssetType\Models\RouteAssetType;

class RouteAssetTypeUpdateAction
{
    public function execute(RouteAssetType $routeAssetType, RouteAssetTypeData $data): RouteAssetType
    {
        $routeAssetType->update([
            'rot_code' => $data->rot_code,
            'att_code' => $data->att_code,
        ]);

        return $routeAssetType->fresh();
    }
}
