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
// When used in controller -> Auth() user used
if (Gate::denies('update-post', $post)) {
    abort(403);
}

// when want to use it for particular/specific user
Gate::forUser($user)->allows('update-post', $post); // true | false

// if we want to override other gates
// in real life - you use Action Control List or Roles
Gate::before(function($user, $ability){
    if($user->is_admin){
        return true;
    }

    return null;
});

// 
Gate::after(function($user, $ability, $result, $arguments){
...
})
```
