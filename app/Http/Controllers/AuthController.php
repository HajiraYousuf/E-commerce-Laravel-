<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function show()
    {
        return view('auth.auth');
    }

    // REGISTER
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);
        Activity::create([
            'email' => $user->email, 
            'action' => 'user_registered',
            'module' => 'users',
            'status' => 'success',
            'date' => now()->toDateString(),
            'time' => now()->toTimeString(),
        ]);
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(new UserNotification($user));
        }

            
        Auth::login($user);

        return redirect()->route('dashboard');
    }

    // LOGIN
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

         if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        // previous page kaydi
        $redirectTo = url()->previous();

        // hubi in previous URL uu yahay login/auth page
        if (
            str_contains($redirectTo, '/auth') ||
            str_contains($redirectTo, '/login') ||
            $redirectTo === url('/')
        ) {
            $redirectTo = null;
        }

        // ADMIN
        if ($user->role === 'admin') {
            return $redirectTo
                ? redirect()->intended($redirectTo)
                : redirect()->route('admin.dashboard');
        }

        // USER
        return $redirectTo
            ? redirect()->intended($redirectTo)
            : redirect('/dashboard');
    }

        return back()->withErrors([
            'email' => 'Invalid email or password',
            'password' =>'Invalid email or password'
        ]);
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth');
    }
}