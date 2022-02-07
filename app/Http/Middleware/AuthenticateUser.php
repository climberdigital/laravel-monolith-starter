<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Closure;

class AuthenticateUser
{
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::guard('web')->check()) {
            return redirect()->route('user.login.index');
        }

        return $next($request);
    }
}
