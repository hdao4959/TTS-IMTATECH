<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdRequest;
use App\Http\Requests\AdUpdateRequest;
use App\Models\Ad;
use App\Models\Post;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ads = Ad::query()->latest('id')->paginate(10);
        return view('admin.ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        return view('admin.ads.create', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('img_thumbnail')) {
            $imagePath = $request->file('img_thumbnail')->store('ads_img', 'public');
            $data['img_thumbnail'] = $imagePath;
        }

        Ad::create($data);

        return redirect()->route('admin.ads.index')->with('success', 'Thêm mới dữ liệu thành công');
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
    public function edit(Ad $ad)
    {
        $posts = Post::all();
        return view('admin.ads.edit', compact('ad', 'posts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdUpdateRequest $request, Ad $ad)
    {
        if ($request->hasFile('img_thumbnail')) {
            $imagePath = $request->file('img_thumbnail')->store('ads_img', 'public');

            if ($ad->img_thumbnail && file_exists(public_path('storage/' . $ad->img_thumbnail))) {
                unlink(public_path('storage/' . $ad->img_thumbnail));
            }

            $ad->img_thumbnail = $imagePath;
        }

        $ad->title = $request->input('title', $ad->title);
        $ad->content = $request->input('content', $ad->content);
        $ad->link = $request->input('link', $ad->link);
        $ad->is_visible = $request->input('is_visible', $ad->is_visible);
        $ad->post_id = $request->input('post_id', $ad->post_id);

        $ad->save();

        return redirect()->back()->with('success', 'Cập nhật dữ liệu thành công.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ad $ad)
    {
        if ($ad->img_thumbnail && file_exists(public_path('storage/' . $ad->img_thumbnail))) {
            unlink(public_path('storage/' . $ad->img_thumbnail));
        }
        $ad->delete();
        return redirect()->back()->with('success', 'Bạn đã xóa thành công.');
    }

    public function is_visible($adId)
    {

        $ads = Ad::find($adId);

        if ($ads) {
            if ($ads->is_visible) {
                $ads->is_visible = 0;
            } else {
                $ads->is_visible = 1;
            }
            $ads->save();
        }
        return back();
    }
}
