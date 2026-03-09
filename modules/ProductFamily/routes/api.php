<?php

use Illuminate\Support\Facades\Route;
use Modules\ProductFamily\Http\Controllers\ProductFamilyController;

Route::apiResource('product_families', ProductFamilyController::class);
