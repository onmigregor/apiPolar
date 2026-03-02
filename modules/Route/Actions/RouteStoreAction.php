<?php

namespace Modules\Route\Actions;

use Modules\Route\DataTransferObjects\RouteData;
use Modules\Route\Models\Route;

class RouteStoreAction
{
    public function execute(RouteData $data): Route
    {
        return Route::create([
            'rot_code' => $data->rot_code,
            'rot_name' => $data->rot_name,
            'lgn_code' => $data->lgn_code,
            'try_code' => $data->try_code,
        ]);
    }
}
