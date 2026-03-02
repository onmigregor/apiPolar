<?php

use Illuminate\Support\Facades\Route as LaravelRoute;
use Modules\Route\Http\Controllers\RouteController;

LaravelRoute::apiResource('routes', RouteController::class);
