# ViewComposers

- called when view rendered
- called each time for a bounded view
- registered in a provider
  - expected, you have `App\Providers\ViewServiceProvider`


```php
<?php
 
namespace App\Providers;
...
 
class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
    }
 
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer('profile', ProfileComposer::class);
 
        // Using closure based composers...
        View::composer('dashboard', function ($view) {
            //
        });

        
        // Attach to multiple views
        View::composer(
            ['profile', 'dashboard'],
            MultiComposer::class
        );

        // Too all views
        View::composer('*', function ($view) {
            //
        });
    }
}
```

## Within ViewComposer

```php
<?php
 
namespace App\View\Composers;
 
use App\Repositories\UserRepository;
use Illuminate\View\View;
 
class ProfileComposer
{
    /**
     * The user repository implementation.
     *
     * @var \App\Repositories\UserRepository
     */
    protected $users;
 
    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }
 
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('count', $this->users->count());
    }
}
```

# ViewCreators

- similar to composers, but executed immediately after the view is instantiated instead of waiting until the view is about to render

```php
use App\View\Creators\ProfileCreator;
use Illuminate\Support\Facades\View;
 
View::creator('profile', ProfileCreator::class);
```