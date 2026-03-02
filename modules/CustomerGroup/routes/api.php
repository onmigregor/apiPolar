<?php

use Illuminate\Support\Facades\Route;
use Modules\CustomerGroup\Http\Controllers\CustomerGroupController;

Route::apiResource('customer_groups', CustomerGroupController::class);
