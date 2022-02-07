<?php

use App\Mail\UserRequestedPasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\User;

test('A guest can submit the password reset form', function () {
    $user = User::factory()->create();

    $this->postJson('/reset-password', [
        'email' => $user->email,
    ])->assertStatus(302)
      ->assertRedirect(route('user.reset-password.index'))
      ->assertSessionHas('started_password_reset');

    expect(
        DB::table('password_resets')
            ->where('email', $user->email)
            ->count()
    )->toBe(1);
});

test('A password reset confirmation will be sent to the user\'s email', function () {
    Mail::fake();

    $user = User::factory()->create();

    $this->postJson('/reset-password', [
        'email' => $user->email,
    ])->assertStatus(302)
      ->assertRedirect(route('user.reset-password.index'))
      ->assertSessionHas('started_password_reset');

    Mail::assertSent(UserRequestedPasswordReset::class);
});
