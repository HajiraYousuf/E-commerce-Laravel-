<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Models\Activity;
use App\Models\Cart;
use App\Models\message;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {

    $user = auth()->user();

    $menuCounts = [
        'users' => User::count(),
        'messages' => message::count(),
        'inventory' => Product::count(),
    ];
    $cartCount = 0;

        if (Auth::check()) {
            $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
        }

        $view->with('cartCount', $cartCount);

    if ($user) {

        $notifications = method_exists($user, 'unreadNotifications')
            ? $user->unreadNotifications()->latest()->take(5)->get()
            : collect();

        $notificationsCount = method_exists($user, 'unreadNotifications')
            ? $user->unreadNotifications()->count()
            : 0;

        $activities = Activity::with('user')->latest()->take(10)->get();

        $view->with([
            'notificationsCount' => $notificationsCount,
            'notifications' => $notifications,
            'activities' => $activities,
            'menuCounts' => $menuCounts, // ✅ ADD THIS
        ]);

    } else {

        $view->with([
            'notificationsCount' => 0,
            'notifications' => collect(),
            'activities' => collect(),
            'menuCounts' => $menuCounts, // ✅ IMPORTANT even for guest
        ]);
    }
});
    }
}