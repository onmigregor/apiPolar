<?php

use Illuminate\Support\Facades\Route;
use Modules\DiscountDetailRoute\Http\Controllers\DiscountDetailRouteController;

Route::apiResource('discount_detail_routes', DiscountDetailRouteController::class);
