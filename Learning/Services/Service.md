# Service

- reusable app-wide functionality

## namespace

- `/services`

- first of all, it's a class


## Service container

- tool that says, how certain classes should be created
- also what dependencies should be passed

`AppServiceProvider.php`

```php
$this->app->bind(Fully qualified name, function($app){
  return new className($parameters)
})
```

### Create instance

- `$this->app->make(FullyQUalifiedName)`

### It's possible to make it singleton
```php
$this->app->singleton(Fully qualified name, function($app){
  return new className($parameters)
})
```

## Facade vs Dependency injection

Facade
- static interface to the service container
- Easy way to access service container via accessor

dependency injection
- Laravel passes it automatically (to the __constructor argument), if defined as service or uses PHP functionality (reflexion) to fetch some meta information

## Contextual binding

https://laravel.com/docs/9.x/container#contextual-binding

- when you need different implementations of the same class with different attributes
```php
$this->app->when([VideoController::class, UploadController::class])
          ->needs(Filesystem::class)
          ->give(function () {
              return Storage::disk('s3');
          });
```
- works also for primitive values

## Contact vs Facade

- contact = interface
  - allow to define explicit dependencies for classes
  - also allows you to have different implementations of certain functionality under same KEY
  
- facade
  - easier way for accessing services
  - most cases, each facade has an equivalent contact

- in packages, use contacts only

## Creating Facades

- `Facades`

```php
/**
 * @method static int increment(...bla)
 */
class DummyFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'Contantct/Name/Whatever defined in as Service'
    }
}
```

- even if `increment()` implemented as non-static method, `Facade` class reroutes static call of that function to that function