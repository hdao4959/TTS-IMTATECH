<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\TryCatch;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const FOLDER_IMG_THUMBNAIL = 'img_thumbnail';
    public function detail(string $slug)
    {
        $post = Post::where('slug', $slug)->with('user')->firstOrFail();
        $comments = Comment::where(
            [
                'parent_id' => null,
                'post_id' => $post->id
            ]
        )->with('user')->get();
        $popularPosts = Post::where('post_status_id', 5)->orderBy('view', 'desc')->limit(5)->get(); 

        // dd($postsHot);

        return view('client.post-detail', compact('post', 'popularPosts', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('client.add-new-post', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {

        $title = $request->title;
        $slug = Str::slug($title);
        $data = [
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'post_status_id' => 2,
            'user_id' => User::inRandomOrder()->firstOrFail()->id
        ];
        dd($data);

        try {
            if ($request->has('img_thumbnail')) {
                $img_thumbnail = $request->file('img_thumbnail');
                $img_path = Storage::put(self::FOLDER_IMG_THUMBNAIL, $img_thumbnail);
                $data['img_thumbnail'] = $img_path;
            }

            Post::create($data);
            // return redirect()->back()->with('message', 'Đăng bài thành công! Chúng tôi sẽ xem xét và phê duyệt bài viết của bạn');
            return "Đăng bài thành công";
        } catch (\Exception $e) {
            if (isset($img_path) && Storage::exists($img_path)) {
                Storage::delete($img_path);
            }
            return "Có lỗi " . $e->getMessage();
        }
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
