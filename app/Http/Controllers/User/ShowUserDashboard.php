<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class ShowUserDashboard extends Controller
{
    public function __invoke()
    {
        return 'user dashboard page';
    }
}
