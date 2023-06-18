<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class Sales
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()){
            return redirect('/login');
        }
        $user = Auth::user();
        if ($user->role == 1) {
            return $next($request);
        }

        if ($user->role == 6) {
            return redirect('/Admin');
        }

        if ($user->role == 3) {
            return redirect('/Store');
        }

        if ($user->role == 4) {
            return redirect('/Logistic');
        }

        if ($user->role == 5) {
            return redirect('/Customer');
        }
        if ($user->role == 2) {
            return redirect('/Purchaser');
        }
    }
}
