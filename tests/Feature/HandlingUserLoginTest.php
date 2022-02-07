<?php

use App\Models\Admin;
use App\Models\User;

test('Logged in users can\'t submit the user login form', function () {
    $this->actingAs(
        User::factory()->create(),
        'web'
    );

    $this->post('/login')->assertStatus(302);
});

test('Logged in admins can\'t submit the user login form', function () {
    $this->actingAs(
        Admin::factory()->create(),
        'admin'
    );

    $this->post('/login')->assertStatus(302);
});

test('Guests can log into their accounts with valid credentials', function () {
    User::factory()->create(['email' => 'john@example.test']);

    $response = $this->post('/login', [
        'email' => 'john@example.test',
        'password' => 'password',
        'remember_me' => false,
    ]);

    $response->assertStatus(302)
             ->assertRedirect(route('user.account.index'));
});

test('Guests logging in with wrong credentials get a validation exception', function () {
    auth()->logout();

    User::factory()->create(['email' => 'john@example.test']);

    $this->postJson('/login', [
        'email' => 'john999@example.test',
        'password' => 'password',
        'remember_me' => false,
    ])->assertStatus(422);
});
