<?php

use Illuminate\Support\Facades\Route;
use Modules\PriceProduct\Http\Controllers\PriceProductController;

Route::apiResource('price_products', PriceProductController::class);
