<?php

use App\Category;
use App\Comment;
use App\Discussion;
use App\Link;
use App\Tag;
use App\User;

it('lists each admin resource', function (string $uri, ?string $model) {
    actingAsApiAdmin();

    if ($model) {
        $model::factory()->create();
    }

    $this->getJson($uri)
        ->assertOk()
        ->assertJsonStructure(['data']);
})->with([
    'users' => ['api/user', User::class],
    'categories' => ['api/category', Category::class],
    'discussions' => ['api/discussion', Discussion::class],
    'comments' => ['api/comment', Comment::class],
    'tags' => ['api/tag', Tag::class],
    'links' => ['api/link', Link::class],
    'visitors' => ['api/visitor', null],
    'roles' => ['api/role', null],
]);

it('shows dashboard statistics', function () {
    actingAsApiAdmin();

    $this->getJson('api/statistics')->assertOk();
});

it('creates a category and a tag', function () {
    actingAsApiAdmin();

    $this->postJson('api/category', [
        'name' => 'Laravel',
        'path' => 'laravel',
        'description' => 'Framework posts',
    ])->assertSuccessful();

    $this->postJson('api/tag', [
        'tag' => 'upgrades',
        'title' => 'Upgrades',
        'meta_description' => 'Upgrade posts',
    ])->assertSuccessful();

    $this->assertDatabaseHas('categories', ['name' => 'Laravel']);
    $this->assertDatabaseHas('tags', ['tag' => 'upgrades']);
});
