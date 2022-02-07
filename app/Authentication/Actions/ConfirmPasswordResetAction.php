<?php

namespace App\Authentication\Actions;

use App\Authentication\Actions\ValidatePasswordResetCredentialsAction;
use App\Http\Requests\Website\ConfirmNewPasswordFormRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ConfirmPasswordResetAction
{
    public function execute(
        ConfirmNewPasswordFormRequest $request
    ) :void
    {
        (new ValidatePasswordResetCredentialsAction)->execute($request);

        $user = User::where('email', $request->input('email'))
            ->firstOrFail();

        $user->password = Hash::make($request->input('password'));
        $user->save();
    }
}