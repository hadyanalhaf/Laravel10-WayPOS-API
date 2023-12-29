<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\PartnerController;
use Illuminate\Support\Facades\Route;

Route::prefix('/partner')->name('partner.')->group(function () {
    Route::get('/', [PartnerController::class, 'get'])->name('get');
        Route::post('/', [PartnerController::class, 'create'])->name('create');
        Route::put('/', [PartnerController::class, 'update'])->name('update');
        Route::delete('/', [PartnerController::class, 'delete'])->name('delete');
        Route::patch('/activate', [PartnerController::class, 'activate'])->name('activate');
        Route::patch('/deactivate', [PartnerController::class, 'deactivate'])->name('deactivate');
});
