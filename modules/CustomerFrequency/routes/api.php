<?php

use Illuminate\Support\Facades\Route;
use Modules\CustomerFrequency\Http\Controllers\CustomerFrequencyController;

Route::apiResource('customer_frequencies', CustomerFrequencyController::class);
