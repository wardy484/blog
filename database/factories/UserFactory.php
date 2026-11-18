<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'status' => true,
            'confirm_code' => Str::random(64),
            'password' => bcrypt('secret'),
            'remember_token' => Str::random(10),
        ];
    }

    public function admin()
    {
        return $this->state(['is_admin' => true]);
    }
}
