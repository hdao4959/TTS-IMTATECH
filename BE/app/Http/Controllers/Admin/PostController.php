<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Post_status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admin.post.';
    const FOLDER_IMG_THUMBNAIL = 'img_thumbnail';
    public function index()
    {
        $posts = Post::with('category', 'post_status')->latest('id')->paginate(10);
        return view(self::PATH_VIEW . __FUNCTION__, compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $post_statuses = Post_status::where('slug', '<>', 'cho-duyet')->get();
        $categories = Category::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('categories', 'post_statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $title = $request->title;
        $slug = Str::slug($title);
        $data = [
            'title' => $title,
            'slug' => $slug,
            'img_thumbnail' => $request->img_thumbnail,
            'description' => $request->description,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'post_status_id' => $request->post_status_id,
            'user_id' => Auth::user()->id
        ];

        try {
            Post::create($data);
            return redirect()->route('admin.posts.index')->with('success', 'Thêm mới bài viết thành công');
        } catch (\Exception $e) {
            return "Có lỗi " . $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug) {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view(self::PATH_VIEW . __FUNCTION__, compact('post'));
    }

    public function edit(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post_statuses = Post_status::get();
        $categories = Category::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('post', 'post_statuses', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        $post = Post::findOrFail($id);
        $data = $request->only('title', 'category_id' ,'description', 'content','post_status_id');
        $data['slug'] = Str::slug($request->title);
        if ($request->img_thumbnail) {
            $data['img_thumbnail'] = $request->img_thumbnail;
        }

        // dd($data);

        try {
            $post->update($data);
            

            return redirect()->route('admin.posts.edit', $post->slug)->with('success', "Sửa bài viết thành công!");
        } catch (\Exception $e) {
            return "Có lỗi " . $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        try {
            $post->delete();
            return redirect()->route('admin.posts.index')->with('success', 'Xoá bài viết ' . $post->title . ' thành công');
        } catch (\Exception $e) {
            return 'Có lỗi' . $e->getMessage();
        }
    }
}
