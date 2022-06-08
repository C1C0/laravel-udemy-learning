<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        // Randomized version of populating users with BlogPosts
        BlogPost::factory()->count(20)->make()->each(function(BlogPost $post) use($users){
            $post->user_id = $users->random()->id;
            $post->save();
        });
    }
}
