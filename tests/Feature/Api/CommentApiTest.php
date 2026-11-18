<?php

use App\Article;
use App\Comment;
use App\User;
use Laravel\Passport\Passport;

it('shows the comments on an article', function () {
    $comment = Comment::factory()->create();

    $this->getJson("api/commentable/{$comment->commentable_id}/comment?commentable_type=articles")
        ->assertOk()
        ->assertJsonPath('data.0.id', $comment->id);
});

it('lets a member comment on an article', function () {
    $article = Article::factory()->create();
    Passport::actingAs(User::factory()->create());

    $this->postJson('api/comments', [
        'content' => 'Nice post',
        'commentable_id' => $article->id,
        'commentable_type' => 'articles',
    ])->assertSuccessful();

    expect($article->comments()->count())->toBe(1);
});

it('lets a member up-vote a comment', function () {
    $comment = Comment::factory()->create();
    $voter = User::factory()->create();
    Passport::actingAs($voter);

    $this->postJson('api/comments/vote/up', ['id' => $comment->id])->assertSuccessful();

    expect($voter->hasUpVoted($comment))->toBeTrue();
});

it('switches a vote and cancels it on a second tap', function () {
    $comment = Comment::factory()->create();
    $voter = User::factory()->create();
    Passport::actingAs($voter);

    $this->postJson('api/comments/vote/up', ['id' => $comment->id]);
    $this->postJson('api/comments/vote/down', ['id' => $comment->id]);

    expect($voter->hasUpVoted($comment))->toBeFalse()
        ->and($voter->hasDownVoted($comment))->toBeTrue();

    $this->postJson('api/comments/vote/down', ['id' => $comment->id]);

    expect($voter->hasDownVoted($comment))->toBeFalse();
});

it('reports the vote count and the viewer vote on a comment', function () {
    $comment = Comment::factory()->create();
    $voter = User::factory()->create();
    $voter->upVote($comment);
    Passport::actingAs($voter);

    $this->getJson("api/commentable/{$comment->commentable_id}/comment?commentable_type=articles")
        ->assertJsonPath('data.0.vote_count', 1)
        ->assertJsonPath('data.0.is_up_voted', true);
});
