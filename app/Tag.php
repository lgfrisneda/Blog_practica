<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //datos que se reciben desde el formulario(array)
    protected $fillable = [
        'name', 'slug'
    ];

    //muchas etiqueta puede tener muchas posts
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
