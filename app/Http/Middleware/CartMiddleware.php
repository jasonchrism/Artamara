<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user()->user_id;
            $cartItems = Cart::where('user_id', $user   )->with('product')->latest()->take(5)->get();
            view()->share('cartItems', $cartItems);
        } else {
            view()->share('cartItems', collect());
        }

        return $next($request);
    }
}
