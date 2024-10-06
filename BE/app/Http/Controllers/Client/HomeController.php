<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function homePage()
    {
        $numberPostsInMain = 20;
        $mainPosts = Post::where('post_status_id', 5)->latest('id')->paginate($numberPostsInMain);
        $popularPosts = Post::where('post_status_id', 5)->orderBy('view', 'desc')->limit(5)->get(); 
        $categories = Category::all();
        $tags = Tag::all();
        return view('client.home', compact('mainPosts','popularPosts', 'categories', 'tags'));
    }

    public function categoryPage(string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        // Lấy các bài viết liên quan đến danh mục 
        $posts = Post::where([
            'category_id' => $category->id,
            'post_status_id' => 5
        ])->paginate(12);
        $popularPosts = Post::where('post_status_id', 5)->orderBy('view', 'desc')->limit(5)->get(); 
        return view('client.category', compact('posts', 'popularPosts', 'category'));
    }

    public function search()
    {
        $keyword = $_GET['keyword'];
        $posts = Post::with('tags')
        ->where(function($query) use ($keyword) {
            $query->where('title', 'like', '%' . $keyword . '%')
                  ->orWhere('description', 'like', '%' . $keyword . '%')
                  ->orWhere('content', 'like', '%' . $keyword . '%');
        })
        ->get();
        return view('client.search', compact('posts', 'keyword'));
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
