# One to Many relations

- In this scenario, we have `BlogPost` and `Comment` model
- BlogPost (one) - Comment (many)

## Save comment on BlogPost
```php
$comm = new Comment();
$comm->content = 'Required  Content';

$bp = BlogPost::find(id);

$bp->comments()->save($comm);

// OR WE CAN ASSOCIATE

$comm2 = new Comment();
$comm2->content = 'Required Content';

$comm2->blogPost()->associate($bp)->save();

// Or assign foreign key directly
```

### Save multiple comments at once
```php
$bp = BlogPost::find(id);

$comm1 = new Comment();
$comm1->content = 'Required  Content';

$comm2 = new Comment();
$comm2->content = 'Required  Content';

$comm3 = new Comment();
$comm3->content = 'Required  Content';

$bp->comments()->saveMany([$comm1, $comm2, $comm3]);
```

## Migration setup - foregin key

```php
/**
 * Run the migrations.
 *
 * @return void
 */
public function up()
{
    Schema::create('comments', function (Blueprint $table) {
        ...

        // use un-big-int because ->id() column has it as default
        $table->unsignedBigInteger('blog_post_id')->index();
        // foreignKey {name} references {column} on {table}
        $table->foreign('blog_post_id')->references('id')->on('blog_posts');
    });
}
```

## Functions for referencing parent/children on models

Comment.php
```php
/*
 * IMPORTANT !
 * - function name has to copy foreignId key column on that same table
 * - function name is converted to snake case and "_id" appended
 * - if function name different (i.e. not as Laravel recommends - changes have to be made everywhere (migration, etc...)
 */
public function blogPost()
{
    /*
     * The way of defining custom foreign_key name
     */
    // return $this->belongsTo(BlogPost::class, 'post_id',);

    /*
     * The way of defining custom referenced id -> e.g. on BlogPost model id column would have name "blog_post_id"
     */
    // return $this->belongsTo(BlogPost::class, null, 'blog_post_id');

    return $this->belongsTo(BlogPost::class);
}
```

BlogPost.php
```php
public function comments()
{
    return $this->hasMany(Comment::class);
}
```
