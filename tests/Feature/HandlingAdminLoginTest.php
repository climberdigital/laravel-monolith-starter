<?php

use App\Models\Admin;
use App\Models\User;

beforeEach(function() {
    $this->login = 'haxxNoCh1llBabyyyy';
});

test('Logged in users can\'t submit the admin login form', function () {
    $this->actingAs(
        User::factory()->create(),
        'web'
    );

    $this->post('/cp-login')->assertStatus(302);
});

test('Logged in admins can\'t submit the admin login form', function () {
    $this->actingAs(
        Admin::factory()->create(),
        'admin'
    );

    $this->post('/cp-login')->assertStatus(302);
});

test('Guests can log into the admin accounts with valid credentials', function () {
    Admin::factory()->create(['login' => $this->login]);

    $response = $this->post('/cp-login', [
        'login' => $this->login,
        'password' => 'password',
        'remember_me' => false,
    ]);

    $response->assertStatus(302)
             ->assertRedirect(route('admin.dashboard.index'));
});

test('Guests logging into admin with wrong credentials get a validation exception', function () {
    Admin::factory()->create(['login' => $this->login]);

    $this->postJson('/cp-login', [
        'login' => 'clearlyWrongLogin',
        'password' => 'password',
        'remember_me' => false,
    ])->assertStatus(422);
});
