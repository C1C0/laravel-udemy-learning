# Events, Listeners and Subscribers

## Event

- dispatches event - tells, that something had happended
- simple class

- dispatch event: `OrderShipped::dispatch($order);`

- Register events and Listeners in `EventServiceProvider`

## Listener

- Handle only 1 event
- can be queued

## Subscriber

- can handle many events
- cannot be queued
- listener class
  - handle action represents one Listener handling event

```php
class UserEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function handleUserLogin($event) {}
 
    /**
     * Handle user logout events.
     */
    public function handleUserLogout($event) {}
 
    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(
            Login::class,
            [UserEventSubscriber::class, 'handleUserLogin']
        );
 
        $events->listen(
            Logout::class,
            [UserEventSubscriber::class, 'handleUserLogout']
        );

        // or

        return [
            Login::class => 'handleUserLogin',
            Logout::class => 'handleUserLogout',
        ];
    }
}
```

- in `EventServiceProvider`

```php
    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        UserEventSubscriber::class,
    ];
```