<?php

use Illuminate\Support\Facades\Route;
use Modules\CustomerRegion\Http\Controllers\CustomerRegionController;

Route::apiResource('customer_regions', CustomerRegionController::class);
