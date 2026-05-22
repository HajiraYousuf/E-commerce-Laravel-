<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // 🔥 IMPORTANT (THIS IS THE REAL FIX)
        $middleware->redirectGuestsTo(fn () => route('auth'));

        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'rider' => \App\Http\Middleware\RiderMiddleware::class,

        ]);
    })
    ->withExceptions(function ($exceptions) {

        // 🔥 THIS FIXES /login → /auth redirect problem
        $exceptions->renderable(function (\Illuminate\Auth\AuthenticationException $e, $request) {

    if ($request->expectsJson()) {
        return response()->json(['message' => 'Unauthenticated'], 401);
    }

    return redirect('/auth'); // ✅ your custom login page
});
    })->create();