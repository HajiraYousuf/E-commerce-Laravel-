<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishlistController;

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('components.user.pages.home');
})->name('home');

Route::get('/products', function () {
    return view('components.user.pages.products');
})->name('products');

/*
|--------------------------------------------------------------------------
| PRODUCT DETAILS
|--------------------------------------------------------------------------
*/

Route::get('/product/{id}', function ($id) {

    $products = [
        'headphone' => [
            'name' => 'Airpods Pro',
            'price' => '$50',
            'image' => 'image1.jpg',
            'desc' => 'High quality sound with noise cancellation.'
        ],
        'iphone' => [
            'name' => 'iPhone 16 PRO',
            'price' => '$1,000',
            'image' => 'image2.jpg',
            'desc' => 'Premium smartphone with advanced camera system.'
        ],
        'laptops' => [
            'name' => 'MacBook Air',
            'price' => '$570',
            'image' => 'image3.jpg',
            'desc' => 'Powerful and lightweight laptop for developers.'
        ],
        'samsung' => [
            'name' => 'Samsung S24 Ultra',
            'price' => '$900',
            'image' => 'image4.jpg',
            'desc' => 'Flagship Android phone with AI features.'
        ],
        'smartwatch' => [
            'name' => 'Apple Watch 8',
            'price' => '$80',
            'image' => 'image5.jpg',
            'desc' => 'Smart health and fitness tracking watch.'
        ],
    ];

    $product = $products[$id] ?? null;

    return view('components.user.pages.show', compact('product', 'id'));
})->name('products.show');

/*
|--------------------------------------------------------------------------
| CHECKOUT
|--------------------------------------------------------------------------
*/

Route::get('/checkout', function () {

    $productId = request()->query('product_id', 'Unknown Product');
    $productName = ucwords(str_replace('-', ' ', $productId));

    return view('components.user.pages.checkout', compact('productName'));
})->name('products.checkout');

/*
|--------------------------------------------------------------------------
| WISHLIST (SESSION BASED)
|--------------------------------------------------------------------------
*/

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::get('/wishlist/add/{product_id}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/store/{id}', [WishlistController::class, 'store'])->name('wishlist.store');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/auth', [AuthController::class, 'show'])->name('auth');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| USER DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('user.dashboard.userdashboard');
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', [PagesController::class, 'dashboard'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

Route::get('/admin/overview', [PagesController::class, 'overview'])->name('admin.overview');
Route::get('/admin/report', [PagesController::class, 'report'])->name('admin.report');
Route::get('/admin/insight', [PagesController::class, 'insight'])->name('admin.insight');
Route::get('/admin/inventory', [PagesController::class, 'inventroy'])->name('admin.inventory');
Route::get('/admin/transaction', [PagesController::class, 'transaction'])->name('admin.transaction');
Route::get('/admin/calendar', [PagesController::class, 'calendar'])->name('admin.calendar');
Route::get('/admin/settings', [PagesController::class, 'settings'])->name('admin.settings');
Route::get('/admin/messages', [PagesController::class, 'messages'])->name('admin.messages');
Route::get('/admin/products', [PagesController::class, 'products'])->name('admin.products');
Route::get('/admin/users-list', [PagesController::class, 'users'])->name('admin.users_list');
Route::get('/admin/roles-permissions', [PagesController::class, 'roles_perm'])->name('admin.roles_perm');
Route::get('/admin/user-activity', [PagesController::class, 'user_activity'])->name('admin.user_activity');

/*
|--------------------------------------------------------------------------
| CATEGORIES
|--------------------------------------------------------------------------
*/

Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories');
Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
Route::post('/admin/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');