<?php

use App\Models\Admin;
use App\Models\User;

test('Users can\'t access user registration page', function () {
    $this->actingAs(
        User::factory()->create(),
        'web'
    );

    $this->get('/register')->assertStatus(302);
});

test('Admins can\'t access user registration page', function () {
    $this->actingAs(
        Admin::factory()->create(),
        'admin'
    );

    $this->get('/register')->assertStatus(302);
});

test('Only guests can access the user registration page', function () {
    $this->get('/register')->assertStatus(200);
});
