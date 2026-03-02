<?php

use Illuminate\Support\Facades\Route;
use Modules\Customer\Http\Controllers\CustomerController;

Route::post('mastercustomer', [CustomerController::class, 'masterCustomer']);
Route::apiResource('customers', CustomerController::class);
