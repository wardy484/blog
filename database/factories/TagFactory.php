<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    public function definition()
    {
        return [
            'tag' => $this->faker->unique()->word(),
            'title' => $this->faker->sentence(),
            'meta_description' => $this->faker->sentence(),
        ];
    }
}
