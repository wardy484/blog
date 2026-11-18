<?php

use App\User;

it('hides the dashboard from guests and members', function () {
    $this->get('dashboard')->assertRedirect('login');

    $this->actingAs(User::factory()->create())
        ->get('dashboard')
        ->assertNotFound();
});

it('opens the dashboard for an admin', function () {
    $this->actingAs(admin())
        ->get('dashboard/articles')
        ->assertOk();
});
