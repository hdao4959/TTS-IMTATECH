<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->latest('id')->paginate(5);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $imagePath = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $imagePath;
        }

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'Thêm mới dữ liệu thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.user.update', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $imagePath = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $imagePath;

            if ($user->avatar && file_exists(public_path('storage/' . $user->avatar))) {
                unlink(public_path('storage/' . $user->avatar));
            }
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Cập nhật dữ liệu thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->avatar && file_exists(public_path('storage/' . $user->avatar))) {
            unlink(public_path('storage/' . $user->avatar));
        }
        $user->delete();
        return redirect()->back()->with('success', 'Bạn đã xóa thành công.');
    }

    public function active($userId){

        $user = User::find($userId);

        if ($user) {
            if ($user->is_active) {
                $user->is_active = 0;
            }
            else{
                $user->is_active = 1;
            }
            $user->save();
        }
        return back();
    }
}
