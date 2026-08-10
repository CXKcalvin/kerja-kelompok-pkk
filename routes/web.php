<?php

use App\Http\Controllers\ControllerAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

// Tampilan Auth & Proses
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login/submit', [LoginController::class, 'authlogin'])->name('authlogin');
Route::post('/register/submit', [LoginController::class, 'authregister'])->name('authregister');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route khusus setelah login (Sebaiknya dilindungi middleware auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/page', [LoginController::class, 'page'])->name('page');
    Route::get('/admin', [ControllerAdmin::class, 'admin'])->name('admin');

    Route::post('/admin/services', [ControllerAdmin::class, 'storeService'])
        ->name('admin.services.store');
    Route::put('/admin/services/{id}', [ControllerAdmin::class, 'updateService'])
        ->name('admin.services.update');
    Route::delete('/admin/services/{id}', [ControllerAdmin::class, 'destroyService'])
        ->name('admin.services.destroy');

    Route::post('/admin/portfolios', [ControllerAdmin::class, 'storePortfolio'])
        ->name('admin.portfolios.store');
    Route::put('/admin/portfolios/{id}', [ControllerAdmin::class, 'updatePortfolio'])
        ->name('admin.portfolios.update');
    Route::delete('/admin/portfolios/{id}', [ControllerAdmin::class, 'destroyPortfolio'])
        ->name('admin.portfolios.destroy');

    Route::put('/admin/status/{id}', [ControllerAdmin::class, 'updateStatus'])
        ->name('admin.status.update');
});
