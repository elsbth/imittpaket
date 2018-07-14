<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $isAdmin = (Auth::user() && Auth::user()->permission == 'admin');
        $request->attributes->add(['isAdmin' => $isAdmin]);

        return $next($request);
    }
}
