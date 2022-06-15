<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCascadeDeleteToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            if (env('DB_CONNECTION') !== 'sqlite_testing') {
                $table->dropConstrainedForeignId('blog_post_id');
            }
        });

        Schema::table('comments', function (Blueprint $table) {
            if (env('DB_CONNECTION') !== 'sqlite_testing') {
                $table->foreignId('blog_post_id')->constrained('blog_posts')->cascadeOnDelete();
            } else {
                $table->foreign('blog_post_id')->references('blog_posts')->on('id')->onDelete('cascade');
            }

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropConstrainedForeignId('blog_post_id');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('blog_post_id')->index();
            $table->foreign('blog_post_id')->references('id')->on('blog_posts');
        });
    }
}
