# Factories

- Saves time

## Specifying locale

- in `config/app.php` set `faker_locale` option

## Generate factory

`php artisan make:factory PostFactory`

```php
// factory example

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->realTextBetween(100, 300),
        ];
    }
}
```

## Not following conventions

- if you don't name your factories the way Laravel expects it OR is placed in different directory
    - call `newFactory()` function in model.php file

```php
/**
 * Create a new factory instance for the model.
 *
 * @return \Illuminate\Database\Eloquent\Factories\Factory
 */
protected static function newFactory()
{
    return FlightFactory::new();
}
```

Make sure you also define model in factory file:

```php
class FlightFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Flight::class;
}
```

## STATES

```php
// in BlogPostFactory.php class

    public function newTitle() // name of state
    {
        return $this->state(function (array $attributes) {
            return [ // overridden attributes
                'title' => 'New Title',
                'content' => 'Content of the blog post',
            ];
        });
    }
```

To use states:

```php
private function createDummyBlogpost(): BlogPost
{
    return BlogPost::factory()->newTitle()->create();
}
```

## Callbacks

```php
class BlogPostFactory extends Factory
{
    ...
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogPost::class;

    public function configure()
    {
        return $this->afterMaking(function (BlogPost $blogPost) {
            //... do something
        })->afterCreating(function (BlogPost $blogPost) {
            //... do something different
        });
    }
    ...
}

// EXAMPLE 2

class AuthorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Author::class;

    public function configure()
    {
        return $this->afterCreating(function (Author $author) {
            $author->profile()->save(Profile::factory()->make());
        });
    }
}
```
