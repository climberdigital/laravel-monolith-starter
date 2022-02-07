<?php

namespace App\Http\Controllers\User;

use App\Authentication\Actions\ProcessLogoutAction;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutUser extends Controller
{
    public function __invoke(Request $request) :RedirectResponse
    {
        (new ProcessLogoutAction)->execute($request, 'web');

        return redirect('/');
    }
}
