# One to One relationship

```php
$table->unsignedBigInteger('author_id')->unique();
$table->foreign('author_id')->references('id')->on('authors');
// OR
$table->foreignId('author_id')->unique()->constrained()->cascadeOnDelete();
```

```php
// Rel. methods

public function author()
{
    return $this->belongsTo(Profile::class);
}

public function profile()
{
    return $this->hasOne(Profile::class);
}
```
