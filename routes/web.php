<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Routes for public pages and admin panel management.
|
*/

use App\Http\Controllers\LeadController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [\App\Http\Controllers\Public\PageController::class, 'about'])->name('about');
Route::get('/contact', [\App\Http\Controllers\Public\PageController::class, 'contact'])->name('contact');
Route::post('/contact/submit', [\App\Http\Controllers\Public\PageController::class, 'submitContact'])->name('contact.submit');
Route::post('/subscribe', [\App\Http\Controllers\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Lead Capture Routes
Route::get('/evolve', [LeadController::class, 'evolve'])->name('evolve');
Route::get('/lead-form', [LeadController::class, 'showForm'])->name('lead.form');
Route::post('/lead-submit', [LeadController::class, 'submitForm'])->name('lead.submit');

// Catalog / Portfolio
Route::get('/catalog', [\App\Http\Controllers\Public\BookController::class, 'index'])->middleware('lead.captured')->name('catalog.index');
Route::get('/book/{slug}', [\App\Http\Controllers\Public\BookController::class, 'show'])->name('book.show');

// Admin Guest Routes (Login)
Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});

// Admin Authenticated Routes
Route::middleware('admin.auth')->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin Resources
    Route::resource('books', BookController::class);
    Route::resource('admins', AdminController::class);

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');

    // Support
    Route::get('/support', [SupportController::class, 'index'])->name('support.index');

    // Activity Logs
    Route::get('/activity-logs', [\App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('activity-logs.index');
    
    // Logout
    Route::post('/logout', [\App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('logout');
});
