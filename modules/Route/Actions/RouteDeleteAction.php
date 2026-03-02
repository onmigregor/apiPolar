<?php

namespace Modules\Route\Actions;

use Modules\Route\Models\Route;

class RouteDeleteAction
{
    public function execute(Route $route): void
    {
        $route->delete();
    }
}
