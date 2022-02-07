<?php

use Illuminate\Support\Facades\Route;

/**
 * To keep the routes file cleaner, import the whole
 * namespace of this route group instead of doing
 * separate controller imports.
 */
use App\Http\Controllers\User;

Route::get('/', User\ShowUserDashboard::class)
    ->name('user.account.index');

Route::post('/logout', User\LogoutUser::class)
    ->name('user.logout');