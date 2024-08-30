<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\Services\SlugService;

class Post extends Model
{
    use HasFactory, SoftDeletes, Sluggable;
    # specify table name
    protected $table = 'posts';
    protected $fillable = ["title", "description", "image", "user_id"];
    protected $dates = ['deleted_at'];
    # relation user
    function user()
    { # define user property
        return $this->belongsTo(User::class);
        # select * from users where id = $this->user_id;
        ## relation --> with user object
    }

    public function sluggable(): array
    {
        return [
            'slug' => [ // Name of the slug field
                'source' => 'title', // The field to base the slug on
            ]
        ];
    }
}
