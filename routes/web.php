<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Takmir API is running!',
        'timestamp' => now(),
        'app_name' => config('app.name'),
        'app_env' => config('app.env'),
        'database' => config('database.default'),
    ]);
});

// Fallback route untuk debugging
Route::fallback(function () {
    return response()->json([
        'status' => 'error',
        'message' => 'Route not found',
        'available_routes' => [
            'GET /' => 'Health check',
            'GET /api/test' => 'API test endpoint',
            'POST /api/login' => 'Login endpoint',
        ]
    ], 404);
});
