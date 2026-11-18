<?php

namespace Database\Factories;

use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscussionFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'last_user_id' => fn (array $attributes) => $attributes['user_id'],
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'status' => true,
        ];
    }
}
