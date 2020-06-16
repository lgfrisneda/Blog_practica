<?php

namespace App\Http\Controllers\Web;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;

class PageController extends Controller
{
    //
    public function blog()
    {
        $posts = Post::orderBy('id', 'DESC')
        ->where('status', 'PUBLISHED')
        ->paginate(3);

        $subtitle = '';
        
        return view('web.posts', compact('posts', 'subtitle'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)
                    ->first();
                    
        $posts = Post::where('category_id', $category->id)
                ->orderBy('id', 'DESC')
                ->where('status', 'PUBLISHED')
                ->paginate(3);

        $subtitle = 'Categoría: '.$category->name;

        return view('web.posts', compact('posts', 'subtitle'));
        
    }

    public function tag($slug)
    {               
        $tag = Tag::where('slug', $slug)
                ->first();

        $posts = Post::whereHas('tags', function($query) use ($slug){
            $query->where('slug', $slug);
        })
                ->orderBy('id', 'DESC')
                ->where('status', 'PUBLISHED')
                ->paginate(3);

        $subtitle = 'Etiqueta: '.$tag->name;

        return view('web.posts', compact('posts', 'subtitle'));
        
    }

    public function autor($slug)
    {
        $autor = User::where('slug', $slug)
                    ->first();

        $posts = Post::where('user_id', $autor->id)
                    ->orderBy('id', 'DESC')
                    ->where('status', 'PUBLISHED')
                    ->paginate(3);

        $subtitle = 'Autor: '.$autor->name;

        return view('web.posts', compact('posts', 'subtitle'));
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('web.post', compact('post'));
    }
}
