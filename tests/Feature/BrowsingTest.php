<?php

use App\Article;
use App\Category;
use App\Link;
use App\Tag;

it('lists categories and shows one with its articles', function () {
    $article = Article::factory()->create();
    $category = $article->category;

    $this->get('category')
        ->assertOk()
        ->assertSee($category->name);

    $this->get("category/{$category->name}")
        ->assertOk()
        ->assertSee($article->title);
});

it('lists tags and shows one with its articles', function () {
    $tag = Tag::factory()->create();
    $article = Article::factory()->create();
    $article->tags()->attach($tag);

    $this->get('tag')
        ->assertOk()
        ->assertSee($tag->tag);

    $this->get("tag/{$tag->tag}")
        ->assertOk()
        ->assertSee($article->title);
});

it('lists links', function () {
    $link = Link::factory()->create();

    $this->get('link')
        ->assertOk()
        ->assertSee($link->name);
});
