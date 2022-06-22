# Policies

- common command: `php artisan make:policy [NAME]`
- more advanced func.: `php artisan make:policy [NAME] --model=[MODEL_NAME]`

## Old way of registering

```php
// After creating Policy file
// Register only one Policy
Gate::define('update-post', [\App\Policies\BlogPostPolicy::class, 'update']);

// Register whole resource of policies
// posts.create, posts.update, posts.view ...
Gate::resource('posts', \App\Policies\BlogPostPolicy::class)
```

### Usage
- basically same as gates

## Better / newer way

in AuthServiceProvider
```php
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        BlogPost::class => BlogPostPolicy::class,
    ];
```

### Usage
