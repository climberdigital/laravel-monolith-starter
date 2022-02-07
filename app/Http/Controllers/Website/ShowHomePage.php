<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

class ShowHomePage extends Controller
{
    public function __invoke() :string
    {
        return 'home';
    }
}
