<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NotBlockedUser
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
        if ($request->user()->is_blocked) {
            return back()->with('error', 'Your Account Has Been Blocked.');
        }
        return $next($request);
    }
}
