<?php

use Illuminate\Support\Facades\Route;
use Modules\Promotion\Http\Controllers\PromotionController;

Route::post('masterpromotion', [PromotionController::class, 'masterPromotion']);
Route::delete('truncate-promotions', [PromotionController::class, 'truncatePromotions']);
