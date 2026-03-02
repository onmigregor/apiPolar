<?php

use Illuminate\Support\Facades\Route;
use Modules\DiscountDetailProduct\Http\Controllers\DiscountDetailProductController;

Route::apiResource('discount_detail_products', DiscountDetailProductController::class);
