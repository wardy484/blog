<?php

namespace Database\Factories;

use App\Category;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    public function definition()
    {
        $title = $this->faker->sentence(5);

        return [
            'user_id' => User::factory(),
            'last_user_id' => fn (array $attributes) => $attributes['user_id'],
            'category_id' => Category::factory(),
            'title' => $title,
            'subtitle' => strtolower($title),
            'content' => $this->faker->paragraph(),
            'page_image' => $this->faker->imageUrl(),
            'meta_description' => $this->faker->sentence(),
            'is_draft' => false,
            'published_at' => $this->faker->dateTimeBetween('-2 months'),
        ];
    }

    public function draft()
    {
        return $this->state(['is_draft' => true]);
    }
}
