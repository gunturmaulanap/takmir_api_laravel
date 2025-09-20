<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\SignUpController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Admin\TakmirController;
use App\Http\Controllers\Api\Superadmin\DashboardController;
use App\Http\Controllers\Api\Superadmin\PermissionController;
use App\Http\Controllers\Api\Superadmin\RoleController;
use App\Http\Controllers\Api\Superadmin\UserController;
use App\Http\Controllers\Api\Superadmin\CategoryController;
use App\Http\Controllers\Api\Admin\JamaahController;
use App\Http\Controllers\Api\Admin\AktivitasJamaahController;
use App\Http\Controllers\Api\Admin\EventController;
use App\Http\Controllers\Api\Admin\EventViewController;
use App\Http\Controllers\Api\Admin\KhatibController;

// Route untuk sign up (register)
Route::post('/signup', [SignUpController::class, '__invoke']);

// route login
Route::post('/login', [LoginController::class, 'index']);

// group route with middleware "auth"
Route::group(['middleware' => 'auth:api'], function () {

    // logout
    Route::post('/logout', [LoginController::class, 'logout']);

    // Grup rute untuk Admin
    Route::prefix('admin')->group(function () {
        // Takmir API
        Route::apiResource('/takmirs', TakmirController::class);

        // Jamaah API
        Route::apiResource('/jamaahs', JamaahController::class);

        // Events API
        Route::apiResource('/events', EventController::class);

        // Event Views (Kalender) API
        Route::get('/event-views', [EventViewController::class, 'index']);

        // Aktivitas Jamaah API
        Route::apiResource('/aktivitas_jamaahs', AktivitasJamaahController::class);

        // Khatib API
        Route::apiResource('/khatibs', KhatibController::class);
    });
});

//group route with prefix "superadmin"
Route::prefix('superadmin')->group(function () {
    //group route with middleware "auth:api"
    Route::group(['middleware' => 'auth:api'], function () {
        //dashboard
        Route::get('/dashboard', DashboardController::class);

        //permissions
        Route::get('/permissions', [PermissionController::class, 'index']);
        Route::get('/permissions/all', [PermissionController::class, 'all']);

        //roles
        Route::resource('roles', RoleController::class);


        //categories
        Route::apiResource('/categories', CategoryController::class);
        Route::get('/categories/all', [App\Http\Controllers\Api\Superadmin\CategoryController::class, 'all']);
        //users
        Route::apiResource('/users', UserController::class);
        Route::put('/users/{id}/toggle-active', [UserController::class, 'toggleActive'])
            ->middleware(['auth:api', 'permission:users.edit']);
    });
});
