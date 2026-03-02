<?php

use Illuminate\Support\Facades\Route;
use Modules\CustomerPrice\Http\Controllers\CustomerPriceController;

Route::apiResource('customer_prices', CustomerPriceController::class);
