<?php

use Illuminate\Support\Facades\Route;
use Modules\CustomerBranch\Http\Controllers\CustomerBranchController;

Route::apiResource('customer_branches', CustomerBranchController::class);
