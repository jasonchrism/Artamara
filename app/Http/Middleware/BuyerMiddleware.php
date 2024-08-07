<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BuyerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guest()){
            return redirect("/");
        }
        if(Auth::check() && Auth::user()->role === 'BUYER'){
            return $next($request);
        }
        if(Auth::check() && Auth::user()->role === 'ARTIST'){
            return redirect("/dashboard/artist/home");
        }
        if(Auth::check() && Auth::user()->role === 'ADMIN'){
            return redirect("/dashboard/admin/home");
        }
    }
}
