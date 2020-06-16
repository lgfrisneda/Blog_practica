<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //datos que se reciben desde el formulario(array)
    protected $fillable = [
        'name', 'slug', 'body'
    ];

    //una categoria puede tener muchas posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
