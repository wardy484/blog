<?php

use App\Article;
use App\Category;

it('blocks the admin API for guests', function () {
    $this->getJson('api/article')->assertUnauthorized();
});

it('lists articles for an admin', function () {
    actingAsApiAdmin();
    Article::factory()->count(2)->create();

    $this->getJson('api/article')
        ->assertOk()
        ->assertJsonCount(2, 'data')
        ->assertJsonStructure([
            'data' => ['*' => ['id', 'title', 'slug', 'content', 'is_draft', 'published_at']],
            'meta' => ['pagination'],
        ]);
});

it('creates an article', function () {
    actingAsApiAdmin();
    $category = Category::factory()->create();

    $this->postJson('api/article', [
        'title' => 'A new article',
        'subtitle' => 'Subtitle',
        'content' => '# Hello',
        'category_id' => $category->id,
        'meta_description' => 'About it',
        'is_original' => true,
        'published_at' => now()->toDateTimeString(),
        'tags' => '[]',
    ])->assertSuccessful();

    $article = Article::where('title', 'A new article')->firstOrFail();
    expect($article->content['html'])->toContain('<h1>Hello</h1>');
});

it('updates and deletes an article', function () {
    actingAsApiAdmin();
    $article = Article::factory()->create();

    $this->getJson("api/article/{$article->id}/edit")->assertOk();

    $this->patchJson("api/article/{$article->id}", [
        'title' => 'Renamed',
        'subtitle' => $article->subtitle,
        'content' => 'Body',
        'category_id' => $article->category_id,
        'meta_description' => 'x',
        'is_draft' => false,
        'is_original' => true,
        'published_at' => now()->toDateTimeString(),
        'tags' => '[]',
    ])->assertSuccessful();

    expect($article->fresh()->title)->toBe('Renamed');

    $this->deleteJson("api/article/{$article->id}")->assertSuccessful();
    $this->assertSoftDeleted('articles', ['id' => $article->id]);
});
