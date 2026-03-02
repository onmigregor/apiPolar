<?php

use Illuminate\Support\Facades\Route;
use Modules\DiscountDetail\Http\Controllers\DiscountDetailController;

Route::apiResource('discount_details', DiscountDetailController::class);
