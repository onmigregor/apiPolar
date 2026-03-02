<?php

use Illuminate\Support\Facades\Route;
use Modules\CustomerInfo\Http\Controllers\CustomerInfoController;

Route::apiResource('customer_infos', CustomerInfoController::class);
