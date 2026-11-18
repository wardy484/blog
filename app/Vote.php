<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public const UP = 'up_vote';

    public const DOWN = 'down_vote';

    protected $fillable = [
        'user_id',
        'votable_type',
        'votable_id',
        'vote_type',
    ];
}
