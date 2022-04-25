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

    public function testSee1BlogPostWhenThereIs1()
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

        # Check if in DB record with attribute
        $this->assertDatabaseHas('blog_posts', [
            'title' => $post->title,
        ]);
    }

    public function testStoreValid()
    {
        $params = [
            'title' => 'Valid title',
            'content' => 'At least 10 characters',
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'The blog post was created');
    }
}
