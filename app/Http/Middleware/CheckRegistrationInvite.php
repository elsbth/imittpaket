<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Invite;

class CheckRegistrationInvite
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
        $token = $request->token;

        //Must not be logged in, use a token, match token with an invite
        if (!Auth::user() && $token && $invite = Invite::where('token' , '=', $token)->first()) {
            return $next($request);
        }

        return redirect(route('home'));

    }
}
