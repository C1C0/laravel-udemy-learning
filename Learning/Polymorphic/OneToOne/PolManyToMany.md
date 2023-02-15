# Polymorphic many to many

- fancy name for very simple thing
  


## Creating tables

```php
// create_images_table

Schema::create('taggables', function(Blueprint $table){
  $table->morphs('taggable');
})
```

## Adjusting poly model

```php
// Image.php

class Tag extends Model
{
  public function blogPosts(){
    return $this->morphedByMany(BlogPost::class, 'taggable');
  }

  public function comments(){
    return $this->morphedByMany(Comment::class, 'taggable');
  }
}
```

```php
class BlogPost extends Model
{
  public function tags(){
    return $this->morphToMany(Tag::class, 'taggable');
  }
}
```

```php
class Comments extends Model
{
  public function tags(){
    return $this->morphToMany(Tag::class, 'taggable');
  }
}
```

```php
BlogPost::tags()->sync($id);
```