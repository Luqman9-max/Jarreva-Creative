<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Routes khusus untuk admin panel.
| Semua route di sini akan memiliki prefix /admin
|
*/

use App\Http\Controllers\Admin\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard & Protected Routes
Route::middleware(\App\Http\Middleware\AdminAuth::class)->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/books', [\App\Http\Controllers\Admin\BookController::class, 'index'])->name('books.index');
});
