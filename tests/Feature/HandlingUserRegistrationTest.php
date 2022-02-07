<?php

use App\Authentication\Actions\RegisterUserAction;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistered;
use App\Models\User;

test('Guests can register an account with valid credentials', function () {
    $response = $this->post('/register', [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@example.test',
        'password' => 'password',
    ]);

    $response->assertStatus(302)
             ->assertRedirect(route('user.register.index'))
             ->assertSessionHas('registration_success');

    expect(User::count())->toBe(1);
});

test('Guests can\'t register an account with an already registered email', function () {
    User::factory()->create(['email' => 'john@example.test']);

    $response = $this->postJson('/register', [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@example.test',
        'password' => 'password',
    ]);

    $response->assertStatus(422);

    expect(User::count())->toBe(1);
});

test('Newly registered users get the email confirmation message', function () {
    Mail::fake();

    $response = $this->postJson('/register', [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@example.test',
        'password' => 'password',
    ]);

    Mail::assertSent(UserRegistered::class);

    $response->assertStatus(302)
             ->assertRedirect(route('user.register.index'))
             ->assertSessionHas('registration_success');
});

test('Using verification link confirms the user email address', function () {
    $user = User::factory()->create([
        'email' => 'john@example.test',
        'email_verified_at' => null,
    ]);

    $signed_url = (new RegisterUserAction)->generateSignedUrl($user->id);

    $this->get($signed_url)
        ->assertRedirect(route('user.account.index'));

    expect(
        $user->fresh()
            ->email_verified_at
            ->toDateTimeString()
    )->toBe(
        now()->toDateTimeString()
    );
});

test('Users with a verified email can\'t access verification link', function () {
    $user = User::factory()->create([
        'email' => 'john@example.test',
    ]);

    $verification_date = $user->email_verified_at;

    $signed_url = (new RegisterUserAction)->generateSignedUrl($user->id);

    $this->get($signed_url)
        ->assertRedirect(route('user.account.index'));

    expect(
        $user->fresh()
            ->email_verified_at
            ->toDateTimeString()
    )->toBe(
        $verification_date->toDateTimeString()
    );
});
