<?php

use Illuminate\Support\Facades\Route;
use Modules\Company\Http\Controllers\MasterCompanyController;

Route::post('mastercompany', [MasterCompanyController::class, 'masterCompany']);
Route::delete('truncate-companies', [MasterCompanyController::class, 'truncateCompanies']);
