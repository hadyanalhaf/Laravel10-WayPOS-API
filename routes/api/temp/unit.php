<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UnitController;

// Route::prefix('/category')->name('category.')->middleware('auth:sanctum')->group(function () {
//     Route::get('/', [CategoryController::class, 'get'])->name('get');
//     Route::post('/', [CategoryController::class, 'create'])->name('create');
//     Route::put('/', [CategoryController::class, 'update'])->name('update');
//     Route::delete('/', [CategoryController::class, 'delete'])->name('delete');
//     Route::patch('/activate', [CategoryController::class, 'activate'])->name('activate');
//     Route::patch('/deactivate', [CategoryController::class, 'deactivate'])->name('deactivate');
// });

Route::prefix('/unit')->name('unit.')->group(function () {
    Route::get('/', [UnitController::class, 'get'])->name('get');
    Route::put('/', [UnitController::class, 'update'])->name('update');
    Route::post('/', [UnitController::class, 'create'])->name('create');
    Route::delete('/', [UnitController::class, 'delete'])->name('delete');
    Route::patch('/activate', [UnitController::class, 'activate'])->name('activate');
    Route::patch('/deactivate', [UnitController::class, 'deactivate'])->name('deactivate');
});
