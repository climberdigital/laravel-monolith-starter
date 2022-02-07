<?php

use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\User;

beforeEach(function() {
    $this->user = User::factory()->create();

    $this->postJson('/reset-password', [
        'email' => $this->user->email,
    ]);

    $this->token = DB::table('password_resets')
        ->first()
        ->token;
});

test('The new password form can\'t be accessed without an email/token pair', function () {
    $this->get('/confirm-password-reset')
        ->assertStatus(401);
});

test('The new password form can\'t be accessed with non-existent credentials', function () {
    DB::table('password_resets')
        ->where('email', $this->user->email)
        ->delete();

    $this->get(
        "/confirm-password-reset?email={$this->user->email}&token={$this->token}"
    )->assertStatus(401);
});

test('Can\'t access the new password form with an expired token', function () {
    DB::table('password_resets')
        ->where('email', $this->user->email)
        ->update([
            'created_at' => now()->subSeconds(
                config('auth.password_timeout') + 3600
            )
        ]);

    $this->get(
        "/confirm-password-reset?email={$this->user->email}&token={$this->token}"
    )->assertStatus(401);
});

test('Authenticated users can\'t access the new password form', function () {
    $this->actingAs($this->user, 'web');

    $this->get(
        "/confirm-password-reset?email={$this->user->email}&token={$this->token}"
    )->assertStatus(302)
     ->assertRedirect(route('user.account.index'));
});

test('Authenticated admins can\'t access the new password form', function () {
    $this->actingAs(Admin::factory()->create(), 'admin');

    $this->get(
        "/confirm-password-reset?email={$this->user->email}&token={$this->token}"
    )->assertStatus(302)
     ->assertRedirect(route('admin.dashboard.index'));
});

test('Guests can access the new password form with valid credentials', function() {
    $this->get(
        "/confirm-password-reset?email={$this->user->email}&token={$this->token}"
    )->assertStatus(200);
});
