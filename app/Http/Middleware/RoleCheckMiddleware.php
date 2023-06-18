<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $userRole = $request->user()->role;

        if ($userRole != $role) {
            abort(403); // Return a HTTP 403 Forbidden response
        }
    
        return $next($request);
    }
}
