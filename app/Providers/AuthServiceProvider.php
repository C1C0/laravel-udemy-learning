<?php

namespace App\Providers;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-post', function (User $user, BlogPost $post) {
            return $post->user_id === $user->id;
        });

        Gate::define('delete-post', function (User $user, BlogPost $post) {
            return $post->user_id === $user->id;
        });

        Gate::before(function($user, $ability){
            if($user->is_admin && in_array($ability, ['update-post', 'delete-post'])){
                return true;
            }

            return null;
        });
    }
}
