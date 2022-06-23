<?php

namespace Tests\Feature;

use App\Http\Controllers\PostsController;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Gate;
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

    public function testSee1BlogPostWhenThereIs1WithComments()
    {
        # Arrange
        $post = $this->createDummyBlogpost();

        Comment::factory(4)->create([
            'blog_post_id' => $post->id,
        ]);

        # Act
        $response = $this->get('/posts');

        # Assert
        $response->assertSeeText($post->title);
        $response->assertSeeText('4 comments');

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
            'user_id' => ($user = $this->user())->id,
        ];

        $this
            ->actingAs($user)
            ->post('/posts', $params)
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

        $this
            ->actingAs($this->user())
            ->post('/posts', $params)
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
        $user = $this->user();
        $post = $this->createDummyBlogpost($user);

        # Check if in DB record with attribute
        // checks all columns
        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        $params = [
            'title' => 'A new named title',
            'content' => 'content was changed',
        ];

        $this
            ->actingAs($user)
            ->put(action([PostsController::class, 'update'], $post), $params)
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
        $user = $this->user();
        $post = $this->createDummyBlogpost($user);

        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        $this
            ->actingAs($user)
            ->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Post Deleted !');
        $this->assertSoftDeleted('blog_posts', $post->getAttributes());
    }

    private function createDummyBlogpost(User $user = null): BlogPost
    {
        return BlogPost::factory()->newTitle()->create(['user_id' => $user ? $user->id : $this->user()->id]);
    }
}
