<?php

use Illuminate\Support\Facades\Route;
use Modules\City\Http\Controllers\CityController;

Route::apiResource('cities', CityController::class);
