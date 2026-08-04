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
    Route::put('/admin/status/{id}', [ControllerAdmin::class, 'updateStatus'])
    ->name('admin.status.update');
    Route::get('/admin', [ControllerAdmin::class, 'admin'])->name('admin');
});