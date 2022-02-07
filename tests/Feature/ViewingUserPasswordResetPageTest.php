<?php

use App\Models\Admin;
use App\Models\User;

test('A guest can access the password reset form', function () {
    $this->get('/reset-password')
        ->assertStatus(200);
});

test('An authenticated user can\'t access the password reset form', function () {
    $this->actingAs(User::factory()->create(), 'web');

    $this->get('/reset-password')
        ->assertStatus(302)
        ->assertRedirect(route('user.account.index'));
});

test('An admin can\'t access the password reset form', function () {
    $this->actingAs(Admin::factory()->create(), 'admin');

    $this->get('/reset-password')
        ->assertStatus(302)
        ->assertRedirect(route('admin.dashboard.index'));
});
