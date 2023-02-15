# Polymorphic one to many

- fancy name for very simple thing
  


## Creating tables

```php
// create_images_table

Schema::create('comments', function(Blueprint $table){
  $table->morphs('commentable');
})
```

## Adjusting poly model

```php
// Image.php

class Comment extends Model
{
  public function commentable(){
    return $this->morphTo();
  }
}
```

```php
// Other model.php

class OtherModel extends Model
{
  public function comments(){
    return $this->morphMany(Comment::class, 'commentable');
  }
}
```

```php
...
OtherModel::find(1)->comments()->saveMany([
  new Comment::make(['content' => $path]),
  new Comment::make(['content' => $path])
])

OtherModel::find(1)->comments()->create(['content' => 'lorem ipsum'])
...
```