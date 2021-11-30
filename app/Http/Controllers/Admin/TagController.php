<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;


class TagController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('can:admin.tags.index')->only('index');
        $this->middleware('can:admin.tags.create')->only('create','store');
        $this->middleware('can:admin.tags.edit')->only('edit', 'update');
        $this->middleware('can:admin.tags.destroy')->only('destroy');

    }
    
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    { 
        $colors = [
            'red' => 'Color Rojo',
            'yellow' => 'Color Amarillo',
            'green' => 'Color Verde',
            'blue' => 'Color Azul',
            'indigo' => 'Color Indigo',
            'purple' => 'Color Morado',
            'pink' => 'Color Rosado'
        ];
        return view('admin.tags.create', compact('colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:tags',
            'color' => 'required'
        ]);
        // return $request->all(); 
        $tag = Tag::create($request->all());
        return redirect()->route('admin.tags.edit', compact('tag'));
    }

    public function edit(Tag $tag)
    {
        $colors = [
            'red' => 'Color Rojo',
            'yellow' => 'Color Amarillo',
            'green' => 'Color Verde',
            'blue' => 'Color Azul',
            'indigo' => 'Color Indigo',
            'purple' => 'Color Morado',
            'pink' => 'Color Rosado'
        ];
        return view('admin.tags.edit', compact('tag','colors'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required',
            'slug' => "required|unique:tags,slug,$tag->id",
            'color' => 'required'
        ]);
        $tag->update($request->all());
        return redirect()->route('admin.tags.edit', compact('tag'))->with('info','La etiqueta se actualizo correctamente');
    }

    public function destroy(Tag $tag)
    {
        $tag_name = $tag->name;
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('info','El tag: "'.$tag_name.'" se ha eleminado');
    }
}
