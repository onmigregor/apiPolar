<?php

use Illuminate\Support\Facades\Route;
use Modules\CustomerRoute\Http\Controllers\CustomerRouteController;

Route::apiResource('customer_routes', CustomerRouteController::class);
