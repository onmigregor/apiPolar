<?php

use Illuminate\Support\Facades\Route;
use Modules\TaxationTax\Http\Controllers\TaxationTaxController;

Route::apiResource('taxation_taxes', TaxationTaxController::class);
