# Gates

Simple closure with name. Verifies, if user is able to perform an action

- registered in `AuthServiceProvider`

### Ability
- name of gate

### Callback
- verification closure
- always receives $user as 1st params

```php
Gate::define('update-post', function (User $user, BlogPost $post) {
    return $post->user_id === $user->id;
});
```

## Usage

```php
if (Gate::denies('update-post', $post)) {
    abort(403);
}
```
