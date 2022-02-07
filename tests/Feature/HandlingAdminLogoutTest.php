<?php

use App\Models\Admin;

test('Logged in admins can logout and be redirected to home page', function () {
    $this->actingAs(Admin::factory()->create(), 'admin');

    $this->post(route('admin.logout'))
        ->assertStatus(302)
        ->assertRedirect('/');
});
