<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;
    protected $guarded =[];

    /**
     * Get the post's image.  One To One (Polymorphic)
     * create
     * $post->image()->create(['image_url'=>'wwww'])
     * get
     * $post->image->image_url
     */
    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }
}
