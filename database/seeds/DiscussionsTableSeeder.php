<?php

namespace Database\Seeders;

use App\Discussion;
use App\User;
use Illuminate\Database\Seeder;

class DiscussionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Discussion::factory()
            ->count(20)
            ->recycle(User::all())
            ->create();
    }
}
