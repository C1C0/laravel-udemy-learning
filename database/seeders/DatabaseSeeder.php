<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $postsCreated = BlogPost::factory(10)->create();

        foreach ($postsCreated as $post){
            Comment::factory(10)->create(['blog_post_id' => $post->id]);
        }
    }
}
