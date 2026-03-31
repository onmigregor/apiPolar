<?php

use Illuminate\Support\Facades\Route;
use Modules\CustomerInfoType\Http\Controllers\CustomerInfoTypeController;

Route::apiResource('customer_info_types', CustomerInfoTypeController::class);
