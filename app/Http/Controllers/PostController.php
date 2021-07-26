<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $posts = Post::orderBy('id', 'desc')->get();
		return view('index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
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
			'title' => 'required|unique:posts',
			'description' => 'required',
			'image'=>'required|mimes:jpeg,jpg,png',
		]);
		
		$image = $request->file('image');
		$imageName = time().'.'.$image->extension();
		$image->storeAs('public/images',$imageName);
		
		$post = new Post();
		$post->title = $request->title;
		$post->description = $request->description;
		$post->image = $imageName;
		$post->save();
		return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $posts = Post::findOrFail($post->id);
		return view('edit', ['posts' => $posts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {	
		$posts = Post::findOrFail($post->id);
		$request->validate([
			'title' => 'required',
			'description' => 'required',
			'image' => 'required|mimes:jpeg,jpg,png'
		]);
		
		$posts->title = $request->title;
		$posts->description = $request->description;
		
		
		if ($request->hasfile('image')) {
		$image = $request->file('image');
		$imageName = time().'.'.$image->extension();
		$image->storeAs('public/images',$imageName);
		$posts->image = $imageName;
		}
		
		$posts->save();
		
		return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
		if(Storage::delete($post->image)) {
		  $avatar->delete();
	    }
		$post->delete();
		return redirect()->route('index');
    }
}
