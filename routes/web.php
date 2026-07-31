<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

// Public Landing Page
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Admin Authentication Routes
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated Admin Dashboard & Management Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Overview
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Settings Editing
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');

    // Menu Management
    Route::get('/menu', [AdminController::class, 'menuIndex'])->name('menu.index');
    Route::get('/menu/download-pdf', [AdminController::class, 'downloadMenuPdf'])->name('menu.download');
    Route::get('/menu/preview', [AdminController::class, 'previewMenu'])->name('menu.preview');
    Route::get('/menu/create', [AdminController::class, 'menuCreate'])->name('menu.create');
    Route::post('/menu', [AdminController::class, 'menuStore'])->name('menu.store');
    Route::get('/menu/{menuItem}/edit', [AdminController::class, 'menuEdit'])->name('menu.edit');
    Route::put('/menu/{menuItem}', [AdminController::class, 'menuUpdate'])->name('menu.update');
    Route::delete('/menu/{menuItem}', [AdminController::class, 'menuDestroy'])->name('menu.destroy');

    // Reviews Management
    Route::get('/reviews', [AdminController::class, 'reviewsIndex'])->name('reviews.index');
    Route::get('/reviews/create', [AdminController::class, 'reviewsCreate'])->name('reviews.create');
    Route::post('/reviews', [AdminController::class, 'reviewsStore'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [AdminController::class, 'reviewsEdit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [AdminController::class, 'reviewsUpdate'])->name('reviews.update');
    Route::patch('/reviews/{review}/toggle', [AdminController::class, 'reviewsToggleActive'])->name('reviews.toggle');
    Route::delete('/reviews/{review}', [AdminController::class, 'reviewsDestroy'])->name('reviews.destroy');
});
