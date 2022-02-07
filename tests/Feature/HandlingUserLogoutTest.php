<?php

use App\Models\User;

test('Logged in users can logout and be redirected to home page', function () {
    $this->actingAs(User::factory()->create(), 'web');

    $this->post(route('user.logout'))
        ->assertStatus(302)
        ->assertRedirect('/');
});
