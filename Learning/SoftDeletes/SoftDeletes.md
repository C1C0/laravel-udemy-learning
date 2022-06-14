# Soft Deletes

### Migration

```php
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->softDeletes();
        });
```

### Model

`use SoftDeletes;`

### Commands

```php
// get also "removed" models
$posts = BlogPost::withTrashed()->get();

// only those removed
$postsTrashed = BlogPost::onlyTrashed()->get();

// Check if model trashed
$postsTrashed[0]->trashed() // true
```
