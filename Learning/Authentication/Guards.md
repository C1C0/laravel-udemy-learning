# Guard

- `Guards are a way to specify how users are authenticated for requests.`1

`In a project I'm working on, I have a jwt (JSON Web Token) guard on my API routes. This means that when I do something like auth()->attempt(['username' => 'test', 'password' => 'test']);, the auth() function will try and authenticate me using the jwt guard.`1

## Properties of guard

### Driver

- either
  - session -> PHP's session (traditional web pages)
  - token -> (API) -> because you send login request once and then have to include TOKEN in all others requests

### User Provider

- driver
  - eloquent
  - database

## In Laravel

- `config/auth.php`

Guards

```php
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],
    ],
```

User Providers

```php
    'providers' => [
        'users' => [ // name of the provider
            'driver' => 'eloquent',
            'model' => App\Models\User::class, // Model to use
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

```

------------
[1](https://stackoverflow.com/a/68723622/10876419)
