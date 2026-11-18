<?php

namespace App\Traits;

use App\Vote;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Voter
{
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function upVote(Model $votable): Vote
    {
        return $this->vote($votable, Vote::UP);
    }

    public function downVote(Model $votable): Vote
    {
        return $this->vote($votable, Vote::DOWN);
    }

    public function hasUpVoted(Model $votable): bool
    {
        return $this->votesOn($votable)->where('vote_type', Vote::UP)->exists();
    }

    public function hasDownVoted(Model $votable): bool
    {
        return $this->votesOn($votable)->where('vote_type', Vote::DOWN)->exists();
    }

    public function cancelVote(Model $votable): void
    {
        $this->votesOn($votable)->delete();
    }

    private function vote(Model $votable, string $type): Vote
    {
        return $this->votes()->updateOrCreate(
            [
                'votable_type' => $votable->getMorphClass(),
                'votable_id' => $votable->getKey(),
            ],
            ['vote_type' => $type],
        );
    }

    private function votesOn(Model $votable): HasMany
    {
        return $this->votes()
            ->where('votable_type', $votable->getMorphClass())
            ->where('votable_id', $votable->getKey());
    }
}
