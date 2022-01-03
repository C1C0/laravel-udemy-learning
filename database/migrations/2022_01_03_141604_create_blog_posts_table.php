<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * php artisan make:model BlogPost -m
 */
class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     * php artisan migrate
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            // Default -> big int
            $table->id();

            // created_at, updated_at
            $table->timestamps();

            $table->string('title');
            $table->text('content');
        });
    }

    /**
     * Reverse the migrations.
     * php artisan migrate:rollback
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
}
