# Middlewares

- can be added to `__construct()` of Controller

```php
public function __construct(){
    $this->middleware('auth');
}
```
