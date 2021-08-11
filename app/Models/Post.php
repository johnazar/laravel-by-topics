<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;


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

    /**
     * Get all of the post's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get all of the tags for the post. Many To Many (Polymorphic)
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public static function allPosts()
    {
        return $posts = app(Pipeline::class)
        ->send(Post::query())
        ->through(
            [
                \App\QueryFilters\Published::class,
                \App\QueryFilters\Sort::class,
                \App\QueryFilters\MaxCount::class

            ]
        )
        ->thenReturn()
        // ->get()
        ->paginate(5);
        // max count wont work wih pagination
    }
}
