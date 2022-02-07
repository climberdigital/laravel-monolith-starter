<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class VerifyUserEmail extends Controller
{
    public function __invoke($user) :RedirectResponse
    {
        $user = User::findOrFail($user);

        if ($user->email_verified_at) {
            return redirect()->route('user.account.index');
        }

        $user->email_verified_at = now();
        $user->save();

        Auth::guard('web')->login($user, true);

        return redirect()->route('user.account.index');
    }
}
