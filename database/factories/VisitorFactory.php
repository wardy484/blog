<?php

namespace Database\Factories;

use App\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitorFactory extends Factory
{
    public function definition()
    {
        return [
            'article_id' => Article::factory(),
            'ip' => $this->faker->ipv4(),
            'country' => 'CN',
            'clicks' => $this->faker->numberBetween(1, 100),
        ];
    }
}
