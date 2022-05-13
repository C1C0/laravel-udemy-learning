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

    public function testSee1BlogPostWhenThereIs1WithNoComments()
    {
        # Arrange
        $post = $this->createDummyBlogpost();

        # Act
        $response = $this->get('/posts');

        # Assert
        $response->assertSeeText($post->title);
        $response->assertSeeText('No comments Yet !');

        # Check if in DB record with attribute
        $this->assertDatabaseHas('blog_posts', [
            'title' => $post->title,
        ]);
    }

    public function testSee1BlogPostWithComments()
    {
        # Arrange
        $post = $this->createDummyBlogpost();

        # Act
        $response = $this->get('/posts');

        # Assert
        $response->assertSeeText($post->title);
        $response->assertSeeText('No comments Yet !');
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

    public function testStoreFail()
    {
        $params = [
            'title' => 'x',
            'content' => 'x',
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        // Yes, you can use dd in tests
//        dd($messages);

        // Magic function
//        $messages->getMessages();

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');

    }

    public function testUpdateValid()
    {
        # Arrange
        $post = $this->createDummyBlogpost();

        # Check if in DB record with attribute
        // checks all colums
        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        $params = [
            'title' => 'A new named title',
            'content' => 'content was changed',
        ];

        $this->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was updated !');

        // Tests that old $post data are not present
        $this->assertDatabaseMissing('blog_posts', $post->getAttributes());

        // Checks the new data
        $this->assertDatabaseHas('blog_posts', [
            'title' => $params['title'],
            'id' => $post->id,
        ]);
    }

    public function testDelete()
    {
        $post = $this->createDummyBlogpost();

        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        $this->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Post Deleted !');
        $this->assertDatabaseMissing('blog_posts', $post->getAttributes());
    }

    private function createDummyBlogpost($title = 'New Title', $content = 'Content of the blog post'): BlogPost
    {
        $post = new BlogPost();
        $post->title = $title;
        $post->content = $content;
        $post->save();

        return $post;
    }
}
