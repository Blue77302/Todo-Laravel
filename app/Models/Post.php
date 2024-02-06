<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Str;

class Post extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;
    protected $table = 'posts';
    protected $attributes = [
        'status' => 0,
    ];
    protected $primaryKey ='id';
    protected $fillable = ['user_id', 'title', 'slug',
    'description', 'content', 'publish_date', 'status'];
    protected $dates = ['deleted_at'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeNew($query)
    {
        return $query->where('status', 0);
    }

    public function scopeUpdated($query)
    {
        return $query->where('status', 1);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 2);
    }

    // public function getThumbnailAttribute()
    // {
    //     return $this->attributes['thumbnail'] ? asset('storage/' . $this->attributes['thumbnail']) :
    //     asset('images/default-thumbnail.jpg');
    // }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = static::generateUniqueSlug($model->title, $model->id);
        });
    }

    public static function generateUniqueSlug($title, $id = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

}
