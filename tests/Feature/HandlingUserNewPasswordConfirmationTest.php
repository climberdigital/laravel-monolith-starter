<?php

use Illuminate\Support\Facades\Hash;
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

test('Guest can submit new password change', function () {
    $response = $this->postJson('/confirm-password-reset', [
        'email' => $this->user->email,
        'token' => $this->token,
        'password' => 'veryNewPassword',
        'password_confirmation' => 'veryNewPassword',
    ]);

    $response->assertStatus(302)
             ->assertRedirect(route('user.reset-password.index'))
             ->assertSessionHas('password_changed');

    expect(Hash::check('veryNewPassword', $this->user->fresh()->password))
        ->toBeTrue();
});

test('Authenticated users can\'t submit new password change', function () {
    $this->actingAs($this->user, 'web');

    $response = $this->postJson('/confirm-password-reset', [
        'email' => $this->user->email,
        'token' => $this->token,
        'password' => 'veryNewPassword',
        'password_confirmation' => 'veryNewPassword',
    ]);

    $response->assertStatus(302)
             ->assertRedirect(route('user.account.index'));

    expect(Hash::check('password', $this->user->fresh()->password))
        ->toBeTrue();
});

test('Authenticated admins can\'t submit new password change', function () {
    $this->actingAs(Admin::factory()->create(), 'admin');

    $response = $this->postJson('/confirm-password-reset', [
        'email' => $this->user->email,
        'token' => $this->token,
        'password' => 'veryNewPassword',
        'password_confirmation' => 'veryNewPassword',
    ]);

    $response->assertStatus(302)
             ->assertRedirect(route('admin.dashboard.index'));

    expect(Hash::check('password', $this->user->fresh()->password))
        ->toBeTrue();
});
