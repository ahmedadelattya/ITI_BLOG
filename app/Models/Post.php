<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Carbon\Carbon;


class Post extends Model
{
    use HasFactory, SoftDeletes, Sluggable;
    # specify table name
    protected $table = 'posts';
    protected $fillable = ["title", "description", "image", "user_id"];
    protected $dates = ['deleted_at'];
    # relation user
    function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }

    // Accessor for human-readable date
    public function getHumanReadableCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
    // Accessor for human-readable updated_at date
    public function getHumanReadableUpdatedAtAttribute()
    {
        return Carbon::parse($this->updated_at)->diffForHumans();
    }
}
