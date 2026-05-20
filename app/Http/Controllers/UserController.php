<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

public function index()
{
    $users = User::latest()->get();

    $stats = [
        [
            'title' => 'Total Users',
            'value' => User::count(),
            'change' => '+12.5%',
            'up' => true,
            'icon' => 'ri-group-line',
            'bg' => 'bg-indigo-100 dark:bg-indigo-500/10',
            'text' => 'text-indigo-600 dark:text-indigo-400',
        ],
        [
            'title' => 'Active Users',
            'value' => User::where('status', 'Active')->count(),
            'change' => '+8.2%',
            'up' => true,
            'icon' => 'ri-user-smile-line',
            'bg' => 'bg-emerald-100 dark:bg-emerald-500/10',
            'text' => 'text-emerald-600 dark:text-emerald-400',
        ],
        [
            'title' => 'Inactive Users',
            'value' => User::where('status', 'Blocked')->count(),
            'change' => '-3.1%',
            'up' => false,
            'icon' => 'ri-user-unfollow-line',
            'bg' => 'bg-red-100 dark:bg-red-500/10',
            'text' => 'text-red-600 dark:text-red-400',
        ],
        [
            'title' => 'New Users',
            'value' => User::where('created_at', '>=', now()->subDays(7))->count(),
            'change' => '+18.7%',
            'up' => true,
            'icon' => 'ri-user-add-line',
            'bg' => 'bg-amber-100 dark:bg-amber-500/10',
            'text' => 'text-amber-600 dark:text-amber-400',
        ],
    ];

    return view('admin.users.index', compact('users', 'stats'));
}
}