<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['uri','title'];
    // protected $guarded =[];

    /**
     * Get all of the posts that are assigned this file. Many To Many (Polymorphic)
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'fileable');
    }
}
