[Based on: Laravel 8 - Eloquent: Collections ]('https://laravel.com/docs/8.x/eloquent-collections')

# Eloquent Model

## Create a new item in DB

to create a **Post** and save it

```php
$post = new BlogPost()
$post->title = "text"
$post->content = "text"
$post->save()
```

should return true

_**`Note`**_: Also the `updated_at` column updates when `->save()` is called.

## Getting Records

To retrieve a record

```php
BlogPost::find(1)

/**
=> App\Models\BlogPost {#4450
     id: 1,
     created_at: "2022-01-03 14:25:49",
     updated_at: "2022-01-03 14:25:49",
     title: "Title",
     content: "content",
   }
 */

```

### Retrieving a record with possible exception

```php
BlogPost::findOrFail(/*<id>*/)

/**
 * Illuminate\Database\Eloquent\ModelNotFoundException with message 'No query results for model [App\Models\BlogPost] 100'
 */
```

### Retrieve all records

```php
$posts = BlogPost::all() // returns collection

/**
* => Illuminate\Database\Eloquent\Collection {#4458
     all: [
       App\Models\BlogPost {#4456
         id: 1,
         created_at: "2022-01-03 14:25:49",
         updated_at: "2022-01-03 14:25:49",
         title: "Title",
         content: "content",
       },
     ],
   }
 */
```

### Retrieve specified records

```php
$posts = BlogPost::find([1,2,3])
```

# Eloquent Collections

Extends Laravel's base collection.

Behaves like arrays.

```php
$posts[0];
```

But also extends it with `collection` functionality.

```php
// Get the first record
$posts->first()

// Get the count of records
$posts->count()
```
