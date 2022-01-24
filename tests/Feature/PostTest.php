<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testNoBlogPostsWhenNothingInDatabase()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No posts here');
    }

    public function tsetsSee1BlogPostWhenThereIs1()
    {
        # Arrange
        $post = new BlogPost();
        $post->title = 'New Title';
        $post->content = 'Content of the blog post';
        $post->save();

        # Act
        $response = $this->get('/posts');

        # Assert
        $response->assertSeeText($post->title);
        $response->assertSeeText($post->content);

        # Check if in DB record with attribute
        $this->assertDatabaseHas('blog_posts', [
            'title' => $post->title,
        ]);
    }
}
