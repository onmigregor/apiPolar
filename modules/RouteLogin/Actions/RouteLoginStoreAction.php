<?php

namespace Modules\RouteLogin\Actions;

use Modules\RouteLogin\DataTransferObjects\RouteLoginData;
use Modules\RouteLogin\Models\RouteLogin;

class RouteLoginStoreAction
{
    public function execute(RouteLoginData $data): RouteLogin
    {
        return RouteLogin::create([
            'rot_code' => $data->rot_code,
            'lgn_code' => $data->lgn_code,
        ]);
    }
}
