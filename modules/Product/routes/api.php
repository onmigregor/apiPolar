<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductController;

Route::apiResource('products', ProductController::class);
Route::post('masterproduct', [ProductController::class, 'masterProduct']);
