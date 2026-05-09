<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// AUTH
Route::get('/auth', [AuthController::class, 'show'])->name('auth');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// USER DASHBOARD
Route::get('/dashboard', function () {
    return view('user.dashboard.userdashboard');
})->middleware('auth')->name('dashboard');

// ADMIN DASHBOARD
Route::get('/admin/dashboard', [PagesController::class, 'dashboard'])->name('admin.dashboard')->middleware(['auth', 'admin']);
Route::get('/admin/overview', [PagesController::class, 'overview'])->name('admin.overview')->middleware(['auth', 'admin']);
Route::get('categories/',[CategoryController::class, 'index'])->name('categories');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('categories/store',[CategoryController::class, 'store'])->name('category.store');