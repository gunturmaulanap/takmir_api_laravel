<?php

use Illuminate\Support\Facades\Route;


// Route untuk sign up (register)
Route::post('/signup', [App\Http\Controllers\Api\Auth\SignUpController::class, '__invoke']);

//route login
Route::post('/login', [App\Http\Controllers\Api\Auth\LoginController::class, 'index']);

//group route with middleware "auth"
Route::group(['middleware' => 'auth:api'], function () {

    //logout
    Route::post('/logout', [App\Http\Controllers\Api\Auth\LoginController::class, 'logout']);
});


//group route with prefix "superadmin"
Route::prefix('superadmin')->group(function () {
    //group route with middleware "auth:api"
    Route::group(['middleware' => 'auth:api'], function () {
        //dashboard
        Route::get('/dashboard', App\Http\Controllers\Api\Superadmin\DashboardController::class);

        // permission set active
        Route::patch('/permissions/{id}/active', [App\Http\Controllers\Api\Superadmin\PermissionController::class, 'setActive']);

        //permissions
        Route::get('/permissions', [\App\Http\Controllers\Api\Superadmin\PermissionController::class, 'index']);

        //permissions all
        Route::get('/permissions/all', [\App\Http\Controllers\Api\Superadmin\PermissionController::class, 'all']);

        //roles all
        Route::get('/roles/all', [\App\Http\Controllers\Api\Superadmin\RoleController::class, 'all']);

        //roles
        Route::apiResource('/roles', App\Http\Controllers\Api\Superadmin\RoleController::class);

        //users
        Route::apiResource('/users', App\Http\Controllers\Api\Superadmin\UserController::class);

        //toggle active user
        Route::put('/users/{id}/toggle-active', [\App\Http\Controllers\Api\Superadmin\UserController::class, 'toggleActive'])->middleware(['auth:api', 'permission:users.edit']);
    });
});
