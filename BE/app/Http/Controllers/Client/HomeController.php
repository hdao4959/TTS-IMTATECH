<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function homePage()
    {
        $numberPostsInMain = 4;
        $mainPosts = Post::paginate($numberPostsInMain);
        $categories = Category::all();
        return view('client.home', compact('mainPosts', 'categories'));
    }

    public function categoryPage(string $slug){
        $category = Category::where('slug', $slug)->firstOrFail();
        // Lấy các bài viết liên quan đến danh mục 
        $posts = Post::where([
            'category_id' => $category->id
        ])->get();
        return view('client.category', compact('posts', 'category'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
