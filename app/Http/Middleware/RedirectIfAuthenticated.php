<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Closure;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('user.account.index');
        }

        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard.index');
        }

        return $next($request);
    }
}
