<?php

use App\Article;

it('lists published articles on the home page', function () {
    $article = Article::factory()->create();

    $this->get('/')
        ->assertOk()
        ->assertSee($article->title);
});

it('hides drafts from guests', function () {
    $draft = Article::factory()->draft()->create();

    $this->get('/')->assertDontSee($draft->title);
    $this->get($draft->slug)->assertNotFound();
});

it('shows an article and counts the visit', function () {
    $article = Article::factory()->create();

    $this->get($article->slug)
        ->assertOk()
        ->assertSee($article->title);

    expect($article->fresh()->view_count)->toBe(1);
    $this->assertDatabaseHas('visitors', [
        'article_id' => $article->id,
        'clicks' => 1,
    ]);
});

it('returns 404 for an unknown article', function () {
    $this->get('no-such-article')->assertNotFound();
});

it('finds articles by search term', function () {
    $match = Article::factory()->create(['title' => 'Upgrading Laravel safely']);
    $other = Article::factory()->create(['title' => 'Baking bread']);

    $this->get('search?q=Laravel')
        ->assertOk()
        ->assertSee($match->title)
        ->assertDontSee($other->title);
});
