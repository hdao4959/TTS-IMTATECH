<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    //

    public function formLogin()
    {

        return view('auth.login');
    }
    public function login(Request $request)
    {
        // Validate input
        $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:8',
            ],
            [
                'email.required' => 'Email không được để trống.',
                'email.email' => 'Email không hợp lệ.',
                'password.required' => 'Mật khẩu không được để trống.',
                'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự.',
            ]
        );

        // Check if the "Remember Me" checkbox is checked
        $remember = $request->has('remember_token');

        // Attempt to log the user in
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            // Check if the account is active
            if ($user->is_active == 1) {
                // Redirect based on the user's role
                if ($user->role_id == 5) {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('home');
                }
            } else {
                // If the account is not active, log out and redirect back to login
                Auth::logout();
                return redirect()->route('login')->with('errorLogin', 'Tài khoản đã bị vô hiệu hóa');
            }
        } else {
            // If the credentials are incorrect, redirect back to login with an error
            return redirect()->route('login')->with('errorLogin', 'Email hoặc mật khẩu không chính xác');
        }
    }

    public function formRegister()
    {
        $roles = Role::query()->take(4)->get();
        return view('auth.register', compact('roles'));
    }
    public function subregister(UserRequest $request)
    {
        //         dd(request()->all());

        // đăng ký người dùng vào hệ thống
        $data = $request->validated();
        // dd($data)
        $data = request()->except('avatar');
        // nếu user ko nhập ảnh
        $data['avatar'] = '';
        //nếu user nhập ảnh
        if (request()->hasFile('avatar')) {
            $path_img = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path_img;
        }

        // dd($data);
        //thêm user vào db
        User::create($data);

        return redirect()->route('login')->with('msg', 'Đăng ký thành công');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('msg', 'Đăng xuất thành công');
    }



    //   profile 
    public function showProfile()
    {
        $user = Auth::user();
        return view('client.profile', compact('user'));
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        $user->name = $request->input('name');
        $user->description = $request->input('description');

        if ($request->hasFile('avatar')) {

            if ($user->avatar) {
                Storage::delete('public/' . $user->avatar);
            }

            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Thông tin của bạn đã được cập nhật.');
    }

    // Đổi mật khẩu

    public function changePassword(Request $request)
{
    // Xác thực dữ liệu đầu vào
    $validatedData = $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|different:current_password',
        'confirm_password' => 'required|same:new_password',
    ]);

    $user = Auth::user(); // Lấy người dùng đang đăng nhập

    // Kiểm tra mật khẩu hiện tại
    if (!Hash::check($validatedData['current_password'], $user->password)) {
        // Thêm lỗi vào mảng lỗi nếu mật khẩu hiện tại không đúng
        return redirect()->route('profile')->withErrors([
            'current_password' => 'Mật khẩu hiện tại không đúng.',
        ]);
    }

    // Nếu mật khẩu hiện tại đúng, cập nhật mật khẩu mới
    $user->password = bcrypt($validatedData['new_password']);
    $user->save();

    return redirect()->route('login')->with('msg', 'Đổi mật khẩu thành công!');
}
}
