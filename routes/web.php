<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WishlistController;

// Bogga Wishlist-ka inuu ina tuso
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');

// Inaan alaab ku darno Wishlist-ka
Route::get('/wishlist/create', [WishlistController::class, 'store'])->name('wishlist.add');



Route::get('/', function () {
    return view('welcome');
});





Route::get('/products', function () {
    return view('components.user.Pages.products');
});
Route::get('/home', function () {
   return view('components.user.Pages.home');
})->name('home');

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
Route::get('/admin/overview', [PagesController::class, 'overview'])->name('admin.overview');
Route::get('/admin/report', [PagesController::class, 'report'])->name('admin.report');
Route::get('/admin/insight', [PagesController::class, 'insight'])->name('admin.insight');
Route::get('/admin/inventroy', [PagesController::class, 'inventroy'])->name('admin.inventory');
Route::get('/admin/transaction', [PagesController::class, 'transaction'])->name('admin.transaction');
Route::get('/admin/calendar', [PagesController::class, 'calendar'])->name('admin.calendar');
Route::get('/admin/settings', [PagesController::class, 'settings'])->name('admin.settings');
Route::get('/admin/messages', [PagesController::class, 'messages'])->name('admin.messages');
Route::get('/admin/products', [PagesController::class, 'products'])->name('admin.products');
Route::get('/admin/users_list', [PagesController::class, 'users'])->name('admin.users_list');
Route::get('/admin/roles_permissions', [PagesController::class, 'roles_perm'])->name('admin.roles_perm');
Route::get('/admin/user_activity', [PagesController::class, 'user_activity'])->name('admin.user_activity');

Route::get('/admin/categories/',[CategoryController::class, 'index'])->name('admin.categories');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/store',[CategoryController::class, 'store'])->name('category.store');

