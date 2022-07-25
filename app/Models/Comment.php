<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function scopeLatest(Builder $query){
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    /*
     * IMPORTANT !
     * - function name has to copy foreignId key column on that same table
     * - function name is converted to snake case and "_id" appended
     * - if function name different (i.e. not as Laravel recommends - changes have to be made everywhere (migration, etc...)
     */
    public function blogPost()
    {
        /*
         * The way of defining custom foreign_key name
         */
        // return $this->belongsTo(BlogPost::class, 'post_id',);

        /*
         * The way of defining custom referenced id -> e.g. on BlogPost model id column would have name "blog_post_id"
         */
        // return $this->belongsTo(BlogPost::class, null, 'blog_post_id');

        return $this->belongsTo(BlogPost::class);
    }
}
