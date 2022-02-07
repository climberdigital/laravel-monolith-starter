<?php

namespace App\Authentication\Actions;

use App\Http\Requests\Website\AdminLoginFormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdminAction
{
    public function execute(AdminLoginFormRequest $request) :void
    {
        $credentials = $request->only(['login', 'password']);

        $result = Auth::guard('admin')
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