<?php

namespace Modules\RouteGeneral\Actions;

use Modules\RouteGeneral\Models\RouteGeneral;

class RouteGeneralDeleteAction
{
    public function execute(RouteGeneral $routeGeneral): void
    {
        $routeGeneral->delete();
    }
}
