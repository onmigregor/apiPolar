<?php

namespace Modules\Route\Actions;

use Modules\Route\DataTransferObjects\RouteData;
use Modules\Route\Models\Route;

class RouteUpdateAction
{
    public function execute(Route $route, RouteData $data): Route
    {
        $route->update([
            'rot_code' => $data->rot_code,
            'rot_name' => $data->rot_name,
            'lgn_code' => $data->lgn_code,
            'try_code' => $data->try_code,
        ]);

        return $route->fresh();
    }
}
