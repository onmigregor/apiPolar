<?php

use Illuminate\Support\Facades\Route;
use Modules\Tax\Http\Controllers\TaxController;

Route::apiResource('taxes', TaxController::class);
