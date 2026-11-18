<?php

use App\Discussion;
use App\User;

it('shows a public profile and its tabs', function () {
    $discussion = Discussion::factory()->create();
    $user = $discussion->user;

    $this->get("user/{$user->name}")->assertOk()->assertSee($user->name);
    $this->get("user/{$user->name}/discussions")->assertOk()->assertSee($discussion->title);
    $this->get("user/{$user->name}/comments")->assertOk();
    $this->get("user/{$user->name}/following")->assertOk();
});

it('lets a member follow another member', function () {
    [$follower, $author] = User::factory()->count(2)->create();

    $this->actingAs($follower)
        ->post("user/follow/{$author->id}")
        ->assertRedirect();

    $this->assertDatabaseHas('followers', [
        'user_id' => $follower->id,
        'follow_id' => $author->id,
    ]);
});

it('shows settings and notifications to the member', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('setting')->assertOk();
    $this->actingAs($user)->get('user/notification')->assertOk();
    $this->actingAs($user)->get('user/profile')->assertOk();
});

it('changes the password', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post('password/change', [
        'old_password' => 'secret',
        'password' => 'new-secret',
        'password_confirmation' => 'new-secret',
    ])->assertRedirect();

    expect(Hash::check('new-secret', $user->fresh()->password))->toBeTrue();
});
