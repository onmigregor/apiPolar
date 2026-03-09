<?php

use Illuminate\Support\Facades\Route;
use Modules\ProductCategory\Http\Controllers\ProductCategoryController;

Route::apiResource('product_categories', ProductCategoryController::class);
