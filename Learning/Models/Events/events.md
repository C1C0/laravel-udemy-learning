# Model Events

###### https://laravel.com/docs/9.x/eloquent#events

- launched when something happens to a model
- `retrieved, creating, created, updating, updated, saving, saved, deleting, deleted, trashed, forceDeleted, restoring, restored, and replicating.`

- `*-ing` ended = BEFORE event
- `*-ed` ended = AFTER event

- `saved, updated, deleting and deleted` are not dispatched during mass updates

```php
class User extends Authenticatable
{
    use Notifiable;
 
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saved' => UserSaved::class,
        'deleted' => UserDeleted::class,
    ];
}
```
## Closures way

```php
class BlogPost extends Model
{
   ...
   
    // OLD WAY
//    public static function boot()
//    {
//        parent::boot();
//
//        static::deleting(function(BlogPost $blogPost){
//            
//        });
//    }

    public static function booted()
    {
        static::deleting(function(BlogPost $blogPost){
                
        });
    }
}
```
