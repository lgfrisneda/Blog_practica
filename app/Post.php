<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //datos que se reciben desde el formulario(array)
    protected $fillable = [
        'user_id', 'category_id', 'name', 'slug', 'excerpt', 'body', 'status', 'file'
    ];

    //un post pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //un post pertenece a una categoria
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //muchos post puede tener muchas etiquetas
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
