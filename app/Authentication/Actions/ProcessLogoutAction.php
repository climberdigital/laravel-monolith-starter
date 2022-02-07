<?php

namespace App\Authentication\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProcessLogoutAction
{
    public function execute(Request $request, $guard = 'web') :void
    {
        Auth::guard($guard)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }
}