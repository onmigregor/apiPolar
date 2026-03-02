<?php

namespace Modules\RouteLogin\Actions;

use Modules\RouteLogin\Models\RouteLogin;

class RouteLoginDeleteAction
{
    public function execute(RouteLogin $routeLogin): void
    {
        $routeLogin->delete();
    }
}
