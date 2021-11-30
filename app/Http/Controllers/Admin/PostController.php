<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.posts.index')->only('index');
        $this->middleware('can:admin.posts.create')->only('create','store');
        $this->middleware('can:admin.posts.edit')->only('edit', 'update');
        $this->middleware('can:admin.posts.destroy')->only('destroy');

    }

    public function index()
    {
        return view('admin.posts.index');
    }

    public function create() 
    {
        // pluck -> solo toma el array de la consulta
        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
        
    }

    public function store(PostRequest $request)
    {
        
        $post = Post::create($request->all()); 

        if ($request->file('file')) {
            $url = Storage::put('posts', $request->file('file'));
            $post->image()->create([
                'url' => $url
            ]);
        }
        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }
        // return view('admin.posts.edit', compact('post'));
        // return redirect()->route('admin.posts.edit', compact('post'));
        return $post;
    }

    public function edit(Post $post)
    {

        $this->authorize('author', $post);
        
        // pluck -> solo toma el array de la consulta
        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();   
        return view('admin.posts.edit', compact('post','categories', 'tags'));
    }

    public function update(PostRequest $request, Post $post)
    {
        
        $this->authorize('author', $post); 

        $post->update($request->all());

        if ($request->file('file')) {
            
            $url = Storage::put('posts', $request->file('file'));       
            
            if ($post->image) {
                Storage::delete($post->image->url);
                $post->image->update([
                    'url' => $url
                ]);
            }else{
                $post->image()->create([ 
                    'url' => $url
                ]);
            }
        }
        if ($request->tags) {
            // $post->tags()->detach($post->tags);
            // $post->tags()->attach($request->tags);
            $post->tags()->sync($request->tags);
        }
         
        return redirect()->route('admin.posts.edit', compact('post'))->with('info','El post se ha actualizado');
    }

    public function destroy(Post $post)
    {
        $this->authorize('author', $post);

        $name_post = $post->name;

        $post->delete();
        
        return redirect()->route('admin.posts.index')->with('info','El post "'.$name_post.'" se ha eleminado');
    }
}
