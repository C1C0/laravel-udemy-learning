# API

## Main settings

in `RouteServiceProvider`

## Difference between normal one and API

- normal one has session, session handling, validation, etc ... keeps state
  - session auth
  - web.php
- API ... just api. Is  `stateless`
  - token auth
  - api.php
  - no cookies


## API controller

- no `Edit` and `Create` actions

## Api.php

- also `Route::apiResource(...);` exists
- you might want to specifiy `namespace()` 
  - defines, where Controllers are being picked up

## Removing wrapping

- either on Resource or Extended resource (`Resource::withoutWrapping()` in AppServiceProvider.php)

- even if disabled, for pagination, will be presented

## Pagination

- `->paginate($perPage)`
- if query needed to append
  - `->appends(['per_page' => 4])`

## Headers

- make sure, that if communicating with Laravel API, add `Accept` and `Content-type` headers

## Authentication

- authentication middleware (default: `web`) with guards
  - `web` | `auth`

### Guards

- driver
  - how authentication is being handled
    - `session` -> browser sends session key and laravel retrievs info from session
    - `token` -> token has to be send on every request
- provider

- to specify the guard: `->middleware('auth:$GUARD')`

### Api authentication in Laravel

- Passport or Sanctum

## Fallback route

- 404
- `Route::fallback()`
- Some might handle it in `Handler.php`

## Testing

```php
$response = $this->postJson('/api/user', ['name' => 'Sally']);

$response
    ->assertStatus(201)
    ->assertJson([
        'created' => true,
    ]);
```