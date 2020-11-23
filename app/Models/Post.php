<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;

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
    public static function uploadImage(Request $request,$image=null){
        if ($request->hasFile('thumbnail')){
            if ($image){
                Storage::delete($image);
            }
            $folder=date('Y-m-d');
           return $request->file('thumbnail')->store("images/{$folder}");
        }
        return null;
    }

    public function getImage()
    {
        if (!$this->thumbnail){
            return asset("no-image.png");
        }
        return  asset("uploads/{$this->thumbnail}");
    }

}
