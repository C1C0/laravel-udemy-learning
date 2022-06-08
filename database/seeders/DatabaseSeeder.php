<?php

namespace Database\Seeders;

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
        // EITHER
//        $this->call(UsersTableSeeder::class);
//        $this->call(BlogPostsTableSeeder::class);
//        $this->call(CommentsTableSeeder::class);

        // OR
        $this->call([
            UsersTableSeeder::class,
            BlogPostsTableSeeder::class,
            CommentsTableSeeder::class
        ]);
    }
}
