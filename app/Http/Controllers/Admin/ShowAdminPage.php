<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ShowAdminPage extends Controller
{
    public function __invoke() :string
    {
        return 'admin';
    }
}
