<?php

use Illuminate\Support\Facades\Route;
use Modules\Price\Http\Controllers\PriceController;

Route::apiResource('prices', PriceController::class);
