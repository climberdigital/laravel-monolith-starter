<?php

use App\Models\Admin;
use App\Models\User;

test('Guests can\'t access the user-specific routes', function () {
    $this->get('/account')->assertStatus(302);
});

test('Admins can\'t access the user-specific routes', function () {
    $this->actingAs(
        Admin::factory()->create(),
        'admin'
    );

    $this->get('/account')->assertStatus(302);
});

test('Only users can access the user-specific routes', function () {
    $this->actingAs(
        User::factory()->create(),
        'web'
    );

    $this->get('/account')->assertStatus(200);
});
