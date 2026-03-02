<?php

use Illuminate\Support\Facades\Route;
use Modules\RouteGeneral\Http\Controllers\RouteGeneralController;

Route::apiResource('route_generals', RouteGeneralController::class);
