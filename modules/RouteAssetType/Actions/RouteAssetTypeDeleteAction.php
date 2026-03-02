<?php

namespace Modules\RouteAssetType\Actions;

use Modules\RouteAssetType\Models\RouteAssetType;

class RouteAssetTypeDeleteAction
{
    public function execute(RouteAssetType $routeAssetType): void
    {
        $routeAssetType->delete();
    }
}
