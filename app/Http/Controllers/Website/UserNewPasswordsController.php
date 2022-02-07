<?php

namespace App\Http\Controllers\Website;

use App\Authentication\Actions\ValidatePasswordResetCredentialsAction;
use App\Authentication\Actions\ConfirmPasswordResetAction;
use App\Http\Requests\Website\ConfirmNewPasswordFormRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserNewPasswordsController extends Controller
{
    public function index(Request $request) :string
    {
        (new ValidatePasswordResetCredentialsAction)->execute($request);

        return 'new password form';
    }

    public function store(ConfirmNewPasswordFormRequest $request) :RedirectResponse
    {
        (new ConfirmPasswordResetAction)->execute($request);

        $request->session()->flash('password_changed', true);

        return redirect()->route('user.reset-password.index');
    }
}
