<?php

namespace Database\Seeders;

use App\Article;
use App\User;
use App\Category;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::factory()
            ->count(20)
            ->recycle(User::all())
            ->recycle(Category::all())
            ->create();
    }
}
