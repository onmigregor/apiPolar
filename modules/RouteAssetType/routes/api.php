<?php

use Illuminate\Support\Facades\Route;
use Modules\RouteAssetType\Http\Controllers\RouteAssetTypeController;

Route::apiResource('route_asset_types', RouteAssetTypeController::class);
