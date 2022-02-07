<?php

namespace App\Http\Controllers\Website;

use App\Authentication\Actions\RegisterUserAction;
use App\Http\Requests\Website\UserRegistrationFormRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class UserRegistrationsController extends Controller
{
    public function index() :string
    {
        if (session()->has('registration_success')) {
            return 'registered successfully';
        }

        return 'user registration page';
    }

    public function store(UserRegistrationFormRequest $request) :RedirectResponse
    {
        (new RegisterUserAction)->execute($request);

        $request->session()->flash('registration_success', true);

        return redirect()->route('user.register.index');
    }
}
