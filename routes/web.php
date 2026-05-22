<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Models\Product;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/

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

Route::get('/admin/dashboard', [DashboardsController::class, 'dashboard'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

Route::get('/admin/overview', [OverviewController::class, 'overview'])->name('admin.overview');
Route::get('/admin/analytics/data', [OverviewController::class, 'analyticsData']);
Route::get('/overview/export',[OverviewController::class,'export'])
    ->name('overview.export');
Route::get('/admin/report', [ReportController::class, 'report'])->name('admin.report');
Route::get('/admin/insight', [PagesController::class, 'insight'])->name('admin.insight');
Route::get('/admin/inventory', [PagesController::class, 'inventroy'])->name('admin.inventory');
Route::get('/admin/transaction', [TransactionController::class, 'index'])->name('admin.transaction');
Route::get('/admin/calendar', [CalendarController::class, 'index'])->name('admin.calendar');
Route::get('/admin/settings', [SettingsController::class, 'index'])->name('admin.settings');
 Route::post('/admin/settings/profile', [SettingsController::class, 'updateProfile'])
            ->name('settings.profile');
 Route::post('/settings/password', [SettingsController::class, 'updatePassword'])
            ->name('settings.password');

         Route::post('/settings/notifications', [SettingsController::class, 'updateNotifications'])
            ->name('settings.notifications.update');
             Route::post('/settings/appearance', [SettingsController::class, 'updateSettings'])
            ->name('settings.update');

Route::get('/admin/messages', [MessageController::class, 'index'])->name('admin.messages');
Route::prefix('admin')
    ->group(function () {

        Route::resource('products', ProductController::class);

    });
    Route::prefix('admin')
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
    })->name('notifications.read');
Route::get('/admin/users-list', [UserController::class, 'index'])->name('admin.users_list');
Route::get('/admin/roles-permissions', [PagesController::class, 'roles_perm'])->name('admin.roles_perm');
Route::get('/admin/user-activity', [PagesController::class, 'user_activity'])->name('admin.user_activity');
Route::get('/admin/global-search', [SearchController::class, 'globalSearch'])
    ->name('admin.global.search');

/*
|--------------------------------------------------------------------------
| CATEGORIES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->group(function () {

        Route::resource('categories', CategoryController::class);

    });
    
Route::prefix('admin')
    ->group(function () {

        Route::resource('customers', CustomerController::class);

    });
Route::get('/admin/reports/download/{type}', [ReportController::class, 'download'])
    ->name('admin.reports.download');

Route::get('/reports/export-all', [ReportController::class, 'exportAll'])
    ->name('reports.export.all');
Route::post('/admin/events', [CalendarController::class, 'store'])->name('admin.events.store');
Route::delete('/admin/events/{event}', [CalendarController::class, 'destroy'])->name('admin.events.delete');