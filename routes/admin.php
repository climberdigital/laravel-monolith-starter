<?php

use Illuminate\Support\Facades\Route;

/**
 * To keep the routes file cleaner, import the whole
 * namespace of this route group instead of doing
 * separate controller imports.
 */
use App\Http\Controllers\Admin;

Route::get('/', Admin\ShowAdminPage::class)
    ->name('admin.dashboard.index');

Route::post('/logout', Admin\LogoutAdmin::class)
    ->name('admin.logout');