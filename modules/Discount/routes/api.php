<?php

use Illuminate\Support\Facades\Route;
use Modules\Discount\Http\Controllers\DiscountController;

Route::apiResource('discounts', DiscountController::class);
Route::post('masterdiscount', [DiscountController::class, 'masterDiscount']);
