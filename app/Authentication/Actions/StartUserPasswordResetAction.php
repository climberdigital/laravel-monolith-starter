<?php

namespace App\Authentication\Actions;

use App\Http\Requests\Website\StartUserPasswordResetFormRequest;
use App\Jobs\SendUserPasswordResetLink;
use App\Models\User;

class StartUserPasswordResetAction
{
    public function execute(StartUserPasswordResetFormRequest $request) :void
    {
        $user = User::where(
            'email',
            $request->input('email')
        )->first();

        $token = app('auth.password.broker')->createToken($user);

        SendUserPasswordResetLink::dispatch(
            $token,
            $user->email
        );
    }
}