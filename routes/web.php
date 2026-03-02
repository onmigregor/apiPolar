<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Serve Swagger API docs JSON (workaround for l5-swagger route issue in Laravel 12)
Route::get('/docs/api-docs.json', function () {
    $path = storage_path('api-docs/api-docs.json');
    if (!file_exists($path)) {
        abort(404, 'API docs not generated. Run: php artisan l5-swagger:generate');
    }
    return response()->file($path, ['Content-Type' => 'application/json']);
});
