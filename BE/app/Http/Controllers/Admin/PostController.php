<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Post_status;
use Illuminate\Http\Request;
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
        $posts = Post::with('category', 'post_status')->latest('id')->paginate(5);
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
            'description' => $request->description,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'post_status_id' => $request->post_status_id,
            'user_id' => 1
        ];

        if ($request->hasFile('img_thumbnail')) {
            $img = Storage::put(self::FOLDER_IMG_THUMBNAIL, $request->file('img_thumbnail'));
            $data['img_thumbnail'] = $img;
        }

        try {
            Post::create($data);
            return redirect()->route('admin.posts.index')->with('success', 'Thêm mới bài viết thành công');
        } catch (\Exception $e) {

            if (isset($data['img_thumbnail']) && Storage::exists($data['img_thumbnail'])) {
                Storage::delete($data['img_thumbnail']);
            }

            return "Có lỗi " . $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $post = Post::findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('post'));
    }

    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
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
        $img_thumbnail_old = $post->img_thumbnail;
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        if ($request->hasFile('img_thumbnail')) {
            $img_thumbnail_new = $request->img_thumbnail;
            $img_path = Storage::put(self::FOLDER_IMG_THUMBNAIL, $img_thumbnail_new);
            $data['img_thumbnail'] = $img_path;
        }

        try {
            $post->update($data);
            if (isset($data['img_thumbnail']) && Storage::exists($img_thumbnail_old)) {
                Storage::delete($img_thumbnail_old);
            }

            return redirect()->back()->with('success', "Sửa bài viết thành công!");
        } catch (\Exception $e) {
            if (isset($data['img_thumbnail']) && Storage::exists($data['img_thumbnail'])) {
                Storage::delete($data['img_thumbnail']);
            }
            return "Có lỗi " . $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        try {
            $post->delete();
            return redirect()->route('admin.posts.index')->with('success', 'Xoá bài viết ' . $post->title . ' thành công');
        } catch (\Exception $e) {
            return 'Có lỗi' . $e->getMessage();
        }
    }
}
