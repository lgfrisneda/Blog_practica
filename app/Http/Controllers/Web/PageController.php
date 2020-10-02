<?php

namespace App\Http\Controllers\Web;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;
use App\Widget;

class PageController extends Controller
{
    //
    public function blog()
    {
        $posts = Post::orderBy('id', 'DESC')
        ->where('status', 'PUBLISHED')
        ->paginate(3);

        $widgets = Widget::orderBy('id', 'ASC')->get();

        $subtitle = '';
        
        return view('web.posts', compact('posts', 'subtitle', 'widgets'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)
                    ->first();
                    
        $posts = Post::where('category_id', $category->id)
                ->orderBy('id', 'DESC')
                ->where('status', 'PUBLISHED')
                ->paginate(3);

        $widgets = Widget::orderBy('id', 'ASC')->get();

        $subtitle = 'Categoría: '.$category->name;

        return view('web.posts', compact('posts', 'subtitle','widgets'));
        
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

        $widgets = Widget::orderBy('id', 'ASC')->get();

        $subtitle = 'Etiqueta: '.$tag->name;

        return view('web.posts', compact('posts', 'subtitle','widgets'));
        
    }

    public function autor($slug)
    {
        $autor = User::where('slug', $slug)
                    ->first();

        $posts = Post::where('user_id', $autor->id)
                    ->orderBy('id', 'DESC')
                    ->where('status', 'PUBLISHED')
                    ->paginate(3);

        $widgets = Widget::orderBy('id', 'ASC')->get();

        $subtitle = 'Autor: '.$autor->name;

        return view('web.posts', compact('posts', 'subtitle','widgets'));
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->first();

        $widgets = Widget::orderBy('id', 'ASC')->get();

        return view('web.post', compact('post', 'widgets'));
    }
}
