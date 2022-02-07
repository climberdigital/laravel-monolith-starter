<?php

use App\Models\Admin;
use App\Models\User;

test('Guests can\'t access the admin routes', function () {
    $this->get('/cp')->assertStatus(302);
});

test('Users can\'t access the admin routes', function () {
    $this->actingAs(
        User::factory()->create(),
        'web'
    );

    $this->get('/cp')->assertStatus(302);
});

test('Only admins can access the admin routes', function () {
    $this->actingAs(
        Admin::factory()->create(),
        'admin'
    );

    $this->get('/cp')->assertStatus(200);
});
