<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->commonUser()->has(BlogPost::factory()->count(3))->create();
        User::factory()->count(3)->has(BlogPost::factory()->count(3))->create();
    }
}
