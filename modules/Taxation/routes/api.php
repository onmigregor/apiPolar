<?php

use Illuminate\Support\Facades\Route;
use Modules\Taxation\Http\Controllers\TaxationController;

Route::apiResource('taxations', TaxationController::class);
