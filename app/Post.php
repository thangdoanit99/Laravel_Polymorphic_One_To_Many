<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['name'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}