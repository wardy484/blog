<?php

use App\User;

it('shows the login and register pages', function () {
    $this->get('login')->assertOk();
    $this->get('register')->assertOk();
});

it('registers a new member', function () {
    $this->post('register', [
        'name' => 'newmember',
        'email' => 'new@example.com',
        'password' => 'secret-password',
        'password_confirmation' => 'secret-password',
    ])->assertRedirect();

    $this->assertDatabaseHas('users', ['email' => 'new@example.com']);
});

it('logs a member in with the right password', function () {
    $user = User::factory()->create();

    $this->post('login', [
        'email' => $user->email,
        'password' => 'secret',
    ])->assertRedirect();

    $this->assertAuthenticatedAs($user);
});

it('rejects the wrong password', function () {
    $user = User::factory()->create();

    $this->post('login', [
        'email' => $user->email,
        'password' => 'wrong',
    ]);

    $this->assertGuest();
});
