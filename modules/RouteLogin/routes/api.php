<?php

use Illuminate\Support\Facades\Route;
use Modules\RouteLogin\Http\Controllers\RouteLoginController;

Route::apiResource('route_logins', RouteLoginController::class);
