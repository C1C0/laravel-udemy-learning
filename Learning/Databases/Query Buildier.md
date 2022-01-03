# Query Builder
`Illuminate\Data\Query\Builder`

Mimics SQL query but with PHP methods.

Always return Collection object - `Illuminate\Database\Eloquent\Collection`

```php
// all queries should end with ->get() method
User::where('id', '>=', 2)->get()
```

### Specifying criteria - where()
```php
User::where(/* Column */, /* sign */, /* Compared value */)->get()
```

### Ordering By - orderBy()
```php
User::orderBy(/* Column */, /* desc | asc */)->get()
```

### Limitink - take()
```php
User::someAction()->take(/* Count */)->get()
```
