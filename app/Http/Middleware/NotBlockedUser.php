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
        if (($extra = $request->user()->extra) && data_get($extra, 'is_blocked', false)) {
            return back()->with('error', 'Your Account Has Been Blocked.');
        }
        return $next($request);
    }
}
