<?php

use App\Category;
use App\Tag;
use App\User;
use Database\Seeders\PermissionTableSeeder;
use Spatie\Permission\Models\Permission;

it('lets an admin publish an article that a reader can comment on', function () {
    $this->seed(PermissionTableSeeder::class);
    $admin = admin();
    $admin->givePermissionTo(Permission::all());
    Category::factory()->create(['name' => 'Upgrades']);
    Tag::factory()->create(['tag' => 'laravel']);

    $this->actingAs($admin);

    $dashboard = visit('/dashboard/articles/create')
        ->click('Select Categories')
        ->click('Upgrades')
        ->click('Select Tags')
        ->click('laravel')
        ->fill('#title', 'Laravel 9 to 13 in one evening')
        ->fill('#subtitle', 'One pull request per step')
        ->fill('#meta_description', 'How the upgrade went')
        ->fill('input[type=datetime-local]', '2026-11-18T09:30');

    $dashboard->script("document.querySelector('.CodeMirror').CodeMirror.setValue('Tests **first**, then upgrade.')");

    $dashboard->press('Create')
        ->assertPathIs('/dashboard/articles')
        ->assertSee('Laravel 9 to 13 in one evening')
        ->assertNoJavaScriptErrors();

    $this->actingAs(User::factory()->create(['name' => 'reader']));

    visit('/')
        ->click('Laravel 9 to 13 in one evening')
        ->assertSeeIn('.markdown strong', 'first')
        ->type('.complete-box textarea', 'Great write-up')
        ->press('Submit')
        ->assertSeeIn('.comment-body', 'Great write-up')
        ->assertNoJavaScriptErrors();
});
