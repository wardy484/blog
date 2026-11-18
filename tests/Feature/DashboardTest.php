<?php

use App\User;
use Database\Seeders\PermissionTableSeeder;
use Spatie\Permission\Models\Permission;

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

it('lets the dashboard call the API with the Passport cookie', function () {
    $this->seed(PermissionTableSeeder::class);
    $admin = admin();
    $admin->givePermissionTo(Permission::all());

    $page = $this->actingAs($admin)->get('dashboard');
    $token = $page->getCookie('laravel_token', decrypt: false)->getValue();

    Auth::forgetGuards();

    $this->withCredentials()
        ->withUnencryptedCookie('laravel_token', $token)
        ->withHeader('X-CSRF-TOKEN', session()->token())
        ->getJson('api/article')
        ->assertOk();
});
