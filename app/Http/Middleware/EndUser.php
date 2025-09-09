<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EndUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('endusers')->check()) {
            return $next($request);
        }
        // If it's an AJAX/axios/fetch request
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        return redirect()->route('login_page');
    }
}
