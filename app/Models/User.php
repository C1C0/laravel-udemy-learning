<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    public function blogPost(): HasMany
    {
        return $this->hasMany(BlogPost::class);
    }

    public function scopeWithMostBlogPosts(Builder $query)
    {
        return $query->withCount('blogPost')->orderBy('blog_post_count', 'desc');
    }

    public function scopeWithMostBlogPostsLastMonth(Builder $query)
    {
        return $query->withCount([
            'blogPost' => function (Builder $query) {
                return $query->whereBetween(static::CREATED_AT, [Carbon::now()->subMonths(2), Carbon::now()]);
        }
        ])
            ->has('blogPost', '>=', 2)
            ->orderBy('blog_post_count', 'desc');
    }
}
