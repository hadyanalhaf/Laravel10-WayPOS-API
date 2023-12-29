<?php

use App\Http\Controllers\Api\V1\AuthenticationController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\WelcomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*--------------------------------------------------------------------------
 API Routes - Version 1
--------------------------------------------------------------------------*/

Route::prefix('v1')->name('v1.')->group(function () {
    // Welcome
    Route::get('/', [WelcomeController::class, 'index'])->name('user');

    // Authentication Group
    Route::prefix('/auth')->name('auth.')->group(function () {
        Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
        Route::post('/register', [AuthenticationController::class, 'register'])->name('register')->middleware('auth:sanctum', 'abilities:register');
        Route::get('/user', [AuthenticationController::class, 'user'])->name('user')->middleware('auth:sanctum');
    });

    // Category Group
    Route::prefix('/category')->name('category.')->middleware('auth:sanctum')->group(function () {
        Route::get('/', [CategoryController::class, 'get'])->name('get');
        Route::post('/', [CategoryController::class, 'create'])->name('create');
        Route::put('/', [CategoryController::class, 'update'])->name('update');
        Route::delete('/', [CategoryController::class, 'delete'])->name('delete');
        Route::patch('/activate', [CategoryController::class, 'activate'])->name('activate');
        Route::patch('/deactivate', [CategoryController::class, 'deactivate'])->name('deactivate');
    });
    

    require __DIR__ . '/temp/temp.php';
});
