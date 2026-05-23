<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Models\Product;
use Illuminate\Http\Request;

Route::get('/auth', [AuthController::class, 'show'])->name('auth');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| USER DASHBOARD
|--------------------------------------------------------------------------
*/

Route::post('/wishlist/toggle/{id}', [WishlistController::class, 'store'])
    ->name('wishlist.toggle');

Route::get('/wishlist', [WishlistController::class, 'index'])
    ->name('wishlist.index');
Route::get('/', [HomeController::class, 'home'])
    ->middleware('auth')
    ->name('home');

Route::get('/shop', [HomeController::class, 'shop'])
    ->name('shop'); 
Route::get('/product/{id}', [HomeController::class, 'productShow'])
    ->name('product.show');    
Route::get('/categories', [HomeController::class, 'categories']);  

Route::get('/categories/{category}', [HomeController::class, 'show'])
    ->name('category.show');

Route::middleware('auth')->group(function () {

    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart');

    Route::post('/cart/add/{productId}', [CartController::class, 'add'])
        ->name('cart.add');

    Route::put('/cart/update/{id}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/cart/{id}', [CartController::class, 'remove'])
        ->name('cart.remove');

    Route::delete('/cart/clear', [CartController::class, 'clear'])
        ->name('cart.clear');
});


Route::get('/category/{id}', [CategoryController::class, 'show'])
    ->name('category.show');
Route::middleware(['auth'])->group(function () {

    Route::get('/orders', [HomeController::class, 'orders'])->name('orders.index');

    Route::get('/orders/{id}', [HomeController::class, 'orderShow'])->name('orders.show');

});

Route::middleware('auth')->group(function () {

    Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');

    Route::post('/place-order', [HomeController::class, 'placeOrder'])->name('place.order');

});
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'sendMessage'])->name('contact.send');

    /*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', [DashboardsController::class, 'dashboard'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

Route::get('/admin/overview', [OverviewController::class, 'overview'])->name('admin.overview')->middleware(['auth', 'admin']);;
Route::get('/admin/analytics/data', [OverviewController::class, 'analyticsData'])->middleware(['auth', 'admin']);
Route::get('/overview/export',[OverviewController::class,'export'])->middleware(['auth', 'admin'])
    ->name('overview.export');
Route::get('/admin/report', [ReportController::class, 'report'])->name('admin.report')->middleware(['auth', 'admin']);
Route::get('/admin/inventory', [PagesController::class, 'inventroy'])->name('admin.inventory')->middleware(['auth', 'admin']);
Route::get('/admin/transaction', [TransactionController::class, 'index'])->name('admin.transaction')->middleware(['auth', 'admin']);
Route::get('/admin/calendar', [CalendarController::class, 'index'])->name('admin.calendar')->middleware(['auth', 'admin']);
Route::get('/admin/settings', [SettingsController::class, 'index'])->name('admin.settings')->middleware(['auth', 'admin']);
Route::post('/admin/settings/profile', [SettingsController::class, 'updateProfile'])->middleware(['auth', 'admin'])
    ->name('settings.profile');
Route::post('/settings/password', [SettingsController::class, 'updatePassword'])->middleware(['auth', 'admin'])
    ->name('settings.password');
Route::post('/settings/notifications', [SettingsController::class, 'updateNotifications'])->middleware(['auth', 'admin'])
    ->name('settings.notifications.update');
Route::post('/settings/appearance', [SettingsController::class, 'updateSettings'])->middleware(['auth', 'admin'])
    ->name('settings.update');
Route::get('/admin/messages', [MessageController::class, 'index'])->name('admin.messages')->middleware(['auth', 'admin']);
Route::prefix('admin')->group(function () {
    Route::resource('products', ProductController::class)->middleware(['auth', 'admin']);
});
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::resource('orders', OrderController::class);

        Route::post(
            '/orders/{order}/update-status',
            [OrderController::class, 'updateStatus']
        )->name('orders.updateStatus');

    });
Route::post('/notifications/read', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return back();
    })->name('notifications.read')->middleware(['auth', 'admin']);
Route::get('/admin/users-list', [UserController::class, 'index'])->name('admin.users_list')->middleware(['auth', 'admin']);
Route::get('/admin/roles-permissions', [PagesController::class, 'roles_perm'])->name('admin.roles_perm')->middleware(['auth', 'admin']);
Route::get('/admin/user-activity', [PagesController::class, 'user_activity'])->name('admin.user_activity')->middleware(['auth', 'admin']);
Route::get('/admin/global-search', [SearchController::class, 'globalSearch'])->middleware(['auth', 'admin'])
    ->name('admin.global.search');

Route::prefix('admin')->group(function () {
        Route::resource('categories', CategoryController::class)->middleware(['auth', 'admin']);
    });   
Route::prefix('admin')->group(function () {
        Route::resource('customers', CustomerController::class)->middleware(['auth', 'admin']);
    });
Route::get('/admin/reports/download/{type}', [ReportController::class, 'download'])->name('admin.reports.download')->middleware(['auth', 'admin']);
Route::get('/reports/export-all', [ReportController::class, 'exportAll'])->name('reports.export.all')->middleware(['auth', 'admin']);
Route::post('/admin/events', [CalendarController::class, 'store'])->name('admin.events.store')->middleware(['auth', 'admin']);
Route::delete('/admin/events/{event}', [CalendarController::class, 'destroy'])->name('admin.events.delete')->middleware(['auth', 'admin']);


Route::prefix('rider')
    ->middleware(['auth', 'rider'])
    ->group(function () {

        Route::get(
            '/orders',
            [RiderController::class, 'index']
        )->name('rider.orders');

        Route::patch(
            '/orders/{order}/delivered',
            [RiderController::class, 'delivered']
        )->name('rider.delivered');

    });