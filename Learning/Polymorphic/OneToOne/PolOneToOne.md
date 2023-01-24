# Polymorphic one to one

- fancy name for very simple thing
  
- in case, we have more models in the app, we want to be able to get a same relationship with one concrete model

- e.g. BlogPost, User and Image
  - BlogPost can have images
  - User can have images

- needs two columns in the "Images" table
  - name prefix (imageable)
  - name suffixes (_id and _type)
  - i.e.: imageable_id, imageable_type


## Creating tables

```php
// create_images_table

Schema::create('images', function(Blueprint $table){
    $table->increments('id');
    $table->string('path');
    $table->unsignedInteger('blog_post_id')->nullable();

    // either
    $table->unsignedInteger('imageable_id');
    $table->string('imageable_type');
    $table->index(["imageable_id", 'imageable_type']);

    // or
    $table->morphs('imageable');

    $table->timestamps();
})
```

## Adjusting poly model

```php
// Image.php

class Image extends Model
{
  public function imageable(){
    return $this->morpthTo();
  }
}
```

```php
// Other model.php

class OtherModel extends Model
{
  public function image(){
    return $this->morpthOne(Image::class, 'imageable');
  }
}
```

```php
...
// do not use Image::create, because by saving imageable _id/_type is assigned
OtherModel::find(1)->image()->save(new Image::make(['path' => $path]))
...
```