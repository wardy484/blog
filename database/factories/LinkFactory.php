<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LinkFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'link' => $this->faker->url(),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
