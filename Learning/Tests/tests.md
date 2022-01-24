# Testing in Laravel
Laravel run tests in separated environment

## Creating tests
`php artisan make:test <Test Class>`

# Unit tests

Test for small isolated parts of code like one class or one meta-functionality

# Feature Tests

Testing specific features

https://github.com/piotr-jura-udemy/laravel-cheat-sheet/blob/master/docs/0028-testing.md

## Naming

Each test function starts with prefix "`test`"

## Extends

Each Test class extends `TestCase` class

## Running tests

`$ ./vendor/bin/phpunit`

## Typical parts of test

```php
class ExampleTest extends TestCase{
```

### 1. Arrange

```php
    public function testBasicTest(){
        $object = new BlogPost();
```

### 2. Act

```php
        $object->save()
```

### 3. Assert

```php
        $this->assertTrue($object->id !== null);
    }
}
```

## Defining Environment Variables
`phpunit.xml`

## Common problems

### Configuration cache
To avoid problems related to having configuration cached - run:
`php artisan config:clear`
