<?php

namespace App\Http\Controllers\Admin;

use App\Authentication\Actions\ProcessLogoutAction;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutAdmin extends Controller
{
    public function __invoke(Request $request) :RedirectResponse
    {
        (new ProcessLogoutAction)->execute($request, 'admin');

        return redirect('/');
    }
}
