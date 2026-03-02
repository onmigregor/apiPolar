<?php

namespace Modules\RouteLogin\Actions;

use Modules\RouteLogin\DataTransferObjects\RouteLoginData;
use Modules\RouteLogin\Models\RouteLogin;

class RouteLoginUpdateAction
{
    public function execute(RouteLogin $routeLogin, RouteLoginData $data): RouteLogin
    {
        $routeLogin->update([
            'rot_code' => $data->rot_code,
            'lgn_code' => $data->lgn_code,
        ]);

        return $routeLogin->fresh();
    }
}
