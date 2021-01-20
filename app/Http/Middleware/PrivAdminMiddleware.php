<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!(Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isPrivileged())))
        {
            return redirect('/');
        }
        
        return $next($request);
    }
}
