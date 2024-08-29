<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            $path_img = $request->file('avatar')->store('images', 'public');
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








}
