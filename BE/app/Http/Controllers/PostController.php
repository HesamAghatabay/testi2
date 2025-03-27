<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = $request->user()->posts;
        return response()->json($posts, 201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = Post::create([
            "title" => $request->title,
            'body' => $request->body,
            'img' => $request->img,
            'writer' => $request->user()->name,
            'user_id' => $request->user()->id,
        ]);
        if (!$post) {
            return response()->json(['status' => false, 'message' => 'create post faild!'], 400);
        }
        return response()->json(['status' => true], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return response()->json(['status' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['status' => true], 200);   
    }
}
