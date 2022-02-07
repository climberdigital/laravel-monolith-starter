<?php

namespace App\Http\Controllers\Website;

use App\Authentication\Actions\AuthenticateUserAction;
use App\Http\Requests\Website\UserLoginFormRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class UserLoginsController extends Controller
{
    public function index() :string
    {
        return 'user login page';
    }

    public function store(UserLoginFormRequest $request) :RedirectResponse
    {
        (new AuthenticateUserAction)->execute($request);

        return redirect()->route('user.account.index');
    }
}
