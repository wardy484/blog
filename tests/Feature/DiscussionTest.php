<?php

use App\Discussion;
use App\Tag;
use App\User;

it('lists and shows discussions', function () {
    $discussion = Discussion::factory()->create();

    $this->get('discussion')
        ->assertOk()
        ->assertSee($discussion->title);

    $this->get("discussion/{$discussion->id}")
        ->assertOk()
        ->assertSee($discussion->title);
});

it('sends guests to log in before starting a discussion', function () {
    $this->get('discussion/create')->assertRedirect('login');
});

it('lets a member start a discussion', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post('discussion', [
            'title' => 'How do I upgrade?',
            'content' => 'Step by step, please.',
            'tags' => [Tag::factory()->create()->id],
        ])
        ->assertRedirect('discussion');

    $this->assertDatabaseHas('discussions', [
        'user_id' => $user->id,
        'title' => 'How do I upgrade?',
    ]);
});

it('lets the author edit their discussion', function () {
    $discussion = Discussion::factory()->create();

    $this->actingAs($discussion->user)
        ->put("discussion/{$discussion->id}", [
            'title' => 'Updated title',
            'content' => 'Updated content',
            'tags' => [Tag::factory()->create()->id],
        ])
        ->assertRedirect("discussion/{$discussion->id}");

    expect($discussion->fresh()->title)->toBe('Updated title');
});
