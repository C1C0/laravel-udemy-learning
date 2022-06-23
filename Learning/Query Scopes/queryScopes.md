# Query Scopes

## Global

Add something (specified) to the default queries that gets executed

### Example

```php
class BlogPost extends Model
{
    ...
    public static function booted()
    {

        // TO REGISTER GLOBAL SCOPE
        static::addGlobalScope(new LatestScope());

        ...
    }
}
```

```php
<?php

namespace App\Scopes;

class LatestScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->orderBy('created_at', 'desc');
    }
}
```

- now all the queries will have "orderBy"
