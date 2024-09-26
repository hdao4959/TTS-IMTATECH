<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::query()->latest('id')->paginate(5);
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|unique:tags,name|max:255',
            // 'slug' => 'required|unique:tags,slug|max:255',
            'slug' => 'unique'
        ],
        [
            'name.required' => 'Tên tag không được để trống.',
            'name.unique' => 'Tên tag đã tồn tại.',
            'name.max' => 'tên tag không được dài quá 255 ký tự',
            // 'slug.required' => 'Slug không được để trống.',
            'slug.unique' => 'Slug đã tồn tại.',
            // 'slug.max' => 'Slug không được dài quá 255 ký tự',
        ]
        );

        $nameTag = $request->name;
        $slug = Str::slug($nameTag);

        $data = [
            'name' => $nameTag,
            'slug' => $slug
        ];

        Tag::create($data);
        // return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
        return redirect()->route('admin.tags.index')->with('success', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {

        //
        $request->validate([
            'name' => 'required|unique:tags,name,'.$tag->id.'|max:255',
        ],
        [
            'name.required' => 'Tên tag không được để trống.',
            'name.unique' => 'Tên tag đã tồn tại.',
            'name.max' => 'Tên tag không được dài quá 255 ký tự',
            'slug.required' => 'Slug không được để trống.',
            'slug.unique' => 'Slug đã tồn tại.',
            'slug.max' => 'Slug không được dài quá 255 ký tự',
        ]
        );
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];
        $tag->update($data);
        return redirect()->back()->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        //
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('success', 'Xóa dữ liệu thành công');
    }
}