<?php

use App\User;
use Database\Seeders\PermissionTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class)->in('Feature');

function admin(): User
{
    return User::factory()->admin()->create();
}

function actingAsApiAdmin(): User
{
    test()->seed(PermissionTableSeeder::class);

    $admin = admin();
    $admin->givePermissionTo(Permission::all());

    Passport::actingAs($admin);

    return $admin;
}
