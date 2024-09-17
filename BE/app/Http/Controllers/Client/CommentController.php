<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $data = [
            'content' => $request->content,
            'post_id' => $request->post_id,
            'user_id' => $request->user_id,
            'parent_id' => $request->parent_id ?? null
        ];
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->post_id = $request->post_id;
        $comment->user_id = $request->user_id;
        $comment->parent_id = $request->parent_id;
        $comment->save();
        // Comment::create($data);
        return "Bình luận thành công";
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->back()->with("success", "Xoá bình luận thành công");
    }
}
