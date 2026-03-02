<?php

use Illuminate\Support\Facades\Route;
use Modules\ProductUnit\Http\Controllers\ProductUnitController;

Route::apiResource('product_units', ProductUnitController::class);
