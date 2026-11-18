<?php

namespace Database\Seeders;

use App\Comment;
use App\User;
use App\Article;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::factory()
            ->count(50)
            ->recycle(User::all())
            ->recycle(Article::all())
            ->create();
    }
}
