# DB One to many data pulling

## Check query relationship presence

### Has and WhereHas

```php
// returns all the BlogPosts, which have any comment available
BlogPost::has('comments')->get();

// returns all the BlogPosts, which have content containing string "abc"
BlogPost::whereHas('comments', function($query){
  $query->where('content', 'like', '%abc%');
})->get();
```

## Check query relationship absence

```php
// returns all the BlogPosts, which doesn't have single comment on it
BlogPost::doesntHave('comments')->get();

// returns all the BlogPosts, which content doesn't contain string "abc"
BlogPost::whereDoesntHave('comments', function($query){
  $query->where('content', 'like', '%abc%');
})->get();
```

## Counting related models
```php
// returns all BlogPosts which has any number of comments
// and plus append amount of comments under "comments_count"
// "comments_count" -> pattern -> $nameOfRelationship_count -> created automatically
// by laravel
BlogPost::withCount('comments')->get();

// Returns all BlogPosts with:
// - 'comments_count' as in previous example
// - 'otherRelationship_count'
// - 'new_comments' -> number of comments obeying the where statement in the closure
BlogPost::withCount(['comments', 'otherRelationship', 'comments as new_comments' => function($query){
    $query->where('created_at', '>=', DATE);
}])->get();
```
