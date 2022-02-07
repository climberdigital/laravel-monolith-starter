<?php

namespace App\Authentication\Traits;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

trait ChecksRequestForResetParams
{
    protected function makeSureRequestHasEmailAndToken(
        Request|FormRequest $request
    ) :void
    {
        if ( !$request->has('email') || !$request->has('token')) {
            abort(401);
        }
    }
}
