<?php

use Illuminate\Support\Facades\Route;

/**
 * To keep the routes file cleaner, import the whole
 * namespace of this route group instead of doing
 * separate controller imports.
 */
use App\Http\Controllers\Website;

Route::get('/', Website\ShowHomePage::class);

Route::get('/login', [Website\UserLoginsController::class, 'index'])
    ->middleware(['guest'])
    ->name('user.login.index');

Route::post('/login', [Website\UserLoginsController::class, 'store'])
    ->middleware(['guest', 'throttle:7,1'])
    ->name('user.login.store');

Route::get('/register', [Website\UserRegistrationsController::class, 'index'])
    ->middleware(['guest'])
    ->name('user.register.index');

Route::get('/register-verify/{user}', Website\VerifyUserEmail::class)
    ->middleware(['guest', 'signed'])
    ->name('user.register.verify');

Route::get('/reset-password', [Website\UserPasswordResetsController::class, 'index'])
    ->middleware(['guest'])
    ->name('user.reset-password.index');

Route::post('/reset-password', [Website\UserPasswordResetsController::class, 'store'])
    ->middleware(['guest', 'throttle:7,1'])
    ->name('user.reset-password.store');

Route::get('/confirm-password-reset', [Website\UserNewPasswordsController::class, 'index'])
    ->middleware(['guest'])
    ->name('user.confirm-password-reset.index');

Route::post('/confirm-password-reset', [Website\UserNewPasswordsController::class, 'store'])
    ->middleware(['guest', 'throttle:7,1'])
    ->name('user.confirm-password-reset.store');

Route::post('/register', [Website\UserRegistrationsController::class, 'store'])
    ->middleware(['guest'])
    ->name('user.register.store');

Route::get('/cp-login', [Website\AdminLoginsController::class, 'index'])
    ->middleware(['guest'])
    ->name('admin.login.show');

Route::post('/cp-login', [Website\AdminLoginsController::class, 'store'])
    ->middleware(['guest', 'throttle:7,1'])
    ->name('admin.login.store');
