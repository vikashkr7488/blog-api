<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
		return CommentResource::collection($comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	 
		$validation = Validator::make($request->all(),[
			'post_id' => 'required',
            'name'=>'required',
            'comment'=>'required',
         ]);
		 
        if ($validation->fails()) {
            return response()->json($validation->errors(),422);
        }
		
		$comment=Comment::create([
            'post_id' => $request->post_id,
            'name' => $request->name,
            'comment' => $request->comment,
        ]);
		
        return response()->json(['result' => 'Record Insert Successfully'], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //$comment = Comment::findOrFail($comment);
		return new CommentResource($comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->name = $request->name;
        $comment->comment = $request->comment;
        $comment->save();

        return response()->json(['result'=>"Updated Succeccfully"],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $result = $comment->delete();
		if ($result) {
			return response()->json(['result' => 'Deleted Successfully'], 200);
		}
    }
}
