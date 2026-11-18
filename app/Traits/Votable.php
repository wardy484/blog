<?php

namespace App\Traits;

use App\User;
use App\Vote;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait Votable
{
    public function voters(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'votes', 'votable_id')
            ->where('votable_type', $this->getMorphClass());
    }

    public function upVoters(): BelongsToMany
    {
        return $this->voters()->where('vote_type', Vote::UP);
    }

    public function isVotedBy(User $user): bool
    {
        return $this->voters()->whereKey($user->getKey())->exists();
    }
}
