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

        $numberOfUsers = (int) max($this->command->ask('How many users would you like ?', 20), 1);

        if ($this->command->confirm('Do you want to create common user ?', true)) {
            User::factory()->commonUser()->has(BlogPost::factory()->count(3))->create();
            $this->command->info('Common testing user created.');
        }

        User::factory()->count($numberOfUsers)->has(BlogPost::factory()->count(3))->create();
    }
}
