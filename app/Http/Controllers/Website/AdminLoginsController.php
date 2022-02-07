<?php

namespace App\Http\Controllers\Website;

use App\Authentication\Actions\AuthenticateAdminAction;
use App\Http\Requests\Website\AdminLoginFormRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class AdminLoginsController extends Controller
{
    public function index() :string
    {
        return 'admin login page';
    }

    public function store(AdminLoginFormRequest $request) :RedirectResponse
    {
        (new AuthenticateAdminAction)->execute($request);

        return redirect()->route('admin.dashboard.index');
    }
}
