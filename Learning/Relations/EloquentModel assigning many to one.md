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

## Lazy loading VS Eager loading

### Lazy loading

- data loaded upon the access required

- NOTE: `Lazy loading` **alleviates** `N+1` Query problem

```php
$post = BlogPost::find(id);

// Lazy loaded data
$post->comments
```

```php
// N+1 query problem

// We get 25 BlogPosts
$posts = BlogPost::all();
 
// This will run 25 SELECT queries to DB
foreach ($posts as $post) {
    echo $post->comments;
}
```

### Eager loading

- pre-loading wanted data

```php
// We get 25 BlogPosts but with pre-loaded comments
$posts = BlogPost::with('comments')->get();
 
// No further queries are sent to DB
foreach ($posts as $post) {
    echo $post->comments;
}
```
```php
// Eager loading multiple relationships
$posts = BlogPost::with(['comments', ['anotherRelationship'])->get();

// Nested eager loading
$posts = BlogPost::with('comments.tags')->get();

// Eager loading specific columns
$posts = BlogPost::with('comments:id,content')->get();

// Constraining eager loading
$posts = BlogPost::with('comments' => functino($query){
    $query->where('id', 2);
    ...OR
    $query->orderBy('created_at', 'desc');
    
    /* !! WATCHOUT !! */
    /* LIMIT and TAKE cannot be use here */
})->get();

```
