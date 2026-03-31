<?php

use Illuminate\Support\Facades\Route;
use Modules\CustomerCity\Http\Controllers\CustomerCityController;

Route::apiResource('customer_cities', CustomerCityController::class);
