<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            Log::info('[Middleware] not authenticated:', ['user' => Auth::user()]);
            return redirect(route('login'));
        }
        Log::info('[Middleware] authenticated:');
        return $next($request);
    }
}