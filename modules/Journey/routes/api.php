<?php

use Illuminate\Support\Facades\Route;
use Modules\Journey\Http\Controllers\JourneyController;

Route::apiResource('journeys', JourneyController::class);
