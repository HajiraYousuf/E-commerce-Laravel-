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

            return redirect('/auth');

        }

        if (auth()->user()->role !== 'rider') {

            return redirect('/auth');

        }

        return $next($request);
    }
}