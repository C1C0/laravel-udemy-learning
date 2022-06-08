<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
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
        $test = User::factory()->commonUser()->has(BlogPost::factory()->count(3))->create();
        $others = User::factory()->count(3)->has(BlogPost::factory()->count(3))->create();

        $users = $others->concat([$test]);

        // Randomized version of populating users with BlogPosts
        $posts = BlogPost::factory()->count(20)->make()->each(function(BlogPost $post) use($users){
            $post->user_id = $users->random()->id;
            $post->save();
        });

        $comments = Comment::factory()->count(150)->make()->each(function(Comment $comment) use($posts){
           $comment->blog_post_id = $posts->random()->id;
           $comment->save();
        });
    }
}
