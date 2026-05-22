<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RiderMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {

            return redirect('/login');

        }

        if (auth()->user()->role !== 'rider') {

            abort(403);

        }

        return $next($request);
    }
}