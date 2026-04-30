<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminAuthController;

// ── Public registration routes ──────────────────────────────────────────────
Route::get('/',          [RegistrationController::class, 'create'])->name('register.form');
Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');

Route::get('/avatar/{registration}',          [RegistrationController::class, 'avatarShow'])->name('avatar.show');
Route::post('/avatar/{registration}/upload',  [RegistrationController::class, 'avatarUpload'])->name('avatar.upload');
Route::get('/avatar/{registration}/download', [RegistrationController::class, 'avatarDownload'])->name('avatar.download');

// ── Admin auth routes (public) ──────────────────────────────────────────────
Route::get('/admin/login',  [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout',[AdminAuthController::class, 'logout'])->name('admin.logout');

// ── Protected dashboard routes ──────────────────────────────────────────────
// ── Protected dashboard routes ──────────────────────────────────────────────
// Use the 'admin' alias defined in bootstrap/app.php
Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard',        [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/export', [DashboardController::class, 'export'])->name('dashboard.export');
});
