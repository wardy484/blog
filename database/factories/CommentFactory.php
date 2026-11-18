<?php

namespace Database\Factories;

use App\Article;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'commentable_type' => 'articles',
            'commentable_id' => Article::factory(),
            'content' => $this->faker->paragraph(),
        ];
    }
}
