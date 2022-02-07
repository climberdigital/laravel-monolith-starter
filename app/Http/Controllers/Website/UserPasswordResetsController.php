<?php

namespace App\Http\Controllers\Website;

use App\Http\Requests\Website\StartUserPasswordResetFormRequest;
use App\Authentication\Actions\StartUserPasswordResetAction;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class UserPasswordResetsController extends Controller
{
    public function index() :string
    {
        return 'password reset form';
    }

    public function store(StartUserPasswordResetFormRequest $request) :RedirectResponse
    {
        (new StartUserPasswordResetAction)->execute($request);

        $request->session()->flash('started_password_reset', true);

        return redirect()->route('user.reset-password.index');
    }
}
