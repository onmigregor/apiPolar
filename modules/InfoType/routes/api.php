<?php

use Illuminate\Support\Facades\Route;
use Modules\InfoType\Http\Controllers\InfoTypeController;

Route::apiResource('info_types', InfoTypeController::class);
