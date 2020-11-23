<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable=['title','description','category_id','thumbnail','content'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();

    }

    public function category()
    {
        return $this->belongsTo(Category::class);

    }
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

}
