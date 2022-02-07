<?php

namespace App\Authentication\Actions;

use App\Http\Requests\Website\UserRegistrationFormRequest;
use App\Jobs\ProcessUserRegistrationMailable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use App\Models\User;

class RegisterUserAction
{
    public function execute(UserRegistrationFormRequest $request) :User
    {
        $user = $this->createUser($request);

        ProcessUserRegistrationMailable::dispatch(
            $this->generateSignedUrl($user->id),
            $user->email
        );

        return $user;
    }

    private function createUser($request)
    {
        $inputData = $request->only([
            'first_name',
            'last_name',
            'email',
        ]);

        $inputData = array_merge($inputData, [
            'password' => Hash::make($request->input('password'))
        ]);

        return User::create($inputData);
    }

    /**
     * Create a signed URL that the email recipient
     * will have to follow from the mailable
     * to verify their email address.
     */
    public function generateSignedUrl(int $id)
    {
        return URL::temporarySignedRoute(
            'user.register.verify',
            now()->addHours(12),
            ['user' => $id]
        );
    }
}