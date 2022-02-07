<?php

namespace App\Authentication\Actions;

use App\Http\Requests\Website\UserLoginFormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthenticateUserAction
{
    public function execute(UserLoginFormRequest $request) :void
    {
        $credentials = $request->only(['email', 'password']);

        $result = Auth::guard('web')
            ->attempt(
                $credentials,
                $request->input('remember_me')
            );

        if (!$result) {
            throw ValidationException::withMessages([
                'invalid_credentials' => __('auth.failed'),
            ]);
        }
    }
}