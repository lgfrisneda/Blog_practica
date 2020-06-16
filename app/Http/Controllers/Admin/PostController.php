<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::where('user_id', auth()->user()->id )->orderBy('id', 'DESC')->paginate(5);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $tags = Tag::orderBy('name', 'ASC')->get();
        
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        //
        $post = Post::create($request->all());

        if($request->file('file')){

            $path = Storage::disk('public')->put('image', $request->file('file'));

            $post->fill(['file' => asset($path)])->save();

        }

        //tags
        $post->tags()->attach($request->get('tags'));

        return redirect()->route('posts.edit', $post->id)->with('info', 'Entrada creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);
        $this->authorize('pass', $post);

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);
        $this->authorize('pass', $post);

        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $tags = Tag::orderBy('name', 'ASC')->get();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        //
        $post = Post::find($id);
        $image_old = $post->file;
        $this->authorize('pass', $post);

        $post->fill($request->all())->save();

        if($request->file('file')){
            //aqui se podria eliminar la imagen anterior
            $image = explode('/', $image_old);
            unlink(public_path().'/image/'.$image[6]);

            $path = Storage::disk('public')->put('image', $request->file('file'));

            $post->fill(['file' => asset($path)])->save();

        }

        //tags
        $post->tags()->sync($request->get('tags'));

        return redirect()->route('posts.edit', $post->id)->with('info', 'Entrada modificada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        $this->authorize('pass', $post);
        //aqui se puede borrar la foto del articulo
        if (!empty($post->file)){
            $image = explode('/', $post->file);
            unlink(public_path().'/image/'.$image[6]);
        }
        $post->delete();

        return back()->with('info', 'Entrada borrada con exito');
    }
}
