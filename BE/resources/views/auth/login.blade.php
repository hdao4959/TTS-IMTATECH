
@extends('client.layout.layout')

@section('title', 'Sign Up')
@section('body-class', 'login-page')
@section('style')
<style>
    /* Gradient và bố cục giao diện */
    .signup-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh; /* Chiếm toàn bộ chiều cao màn hình trừ phần menu */
        margin-top: 20px;
    }

    .signup-box {
        display: flex;
        width: 100%;
        max-width: 900px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .signup-left {
        flex: 1;
        background: linear-gradient(45deg, #FF758C, #7046E9);
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 40px;
    }

    .signup-left h1 {
        font-size: 3rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .signup-left p {
        font-size: 1.2rem;
        margin-top: 5px;
    }

    .signup-right {
        flex: 1;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .form-control {
        border-radius: 5px;
        margin-bottom: 20px;
        font-size: 1rem;
        padding: 10px;
    }

    .btn-primary {
        background-color: #6366F1;
        border: none;
        border-radius: 5px;
        padding: 10px;
        font-size: 1rem;
    }

    .btn-primary:hover {
        background-color: #4a4ecb;
    }

    .google-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #fff;
        border: 1px solid #ccc;
        color: #4C89F3;
        padding: 10px;
        border-radius: 5px;
        text-decoration: none;
        margin-top: 15px;
        font-size: 1rem;
    }

    .google-btn img {
        width: 20px;
        margin-right: 10px;
    }

    /* Ẩn phần trái ở màn hình nhỏ */
    @media (max-width: 768px) {
        .signup-box {
            flex-direction: column;
        }

        .signup-left {
            display: none;
        }

        .signup-right {
            width: 100%;
            padding: 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="signup-container">
    <div class="signup-box">
        <!-- Phần trái -->
        <div class="signup-left">
            <h1>Engadget</h1>
            <p>Chào mừng đến với Engadget</p>
            <p>Tạo tài khoản và tham gia cộng đồng</p>
        </div>

        <!-- Phần phải -->
        <div class="signup-right">
            <h2 class="mb-3 text-center ">Engadget</h2>
            <p class="text-center">Xin chào bạn!</p>
            <h4 class="text-center">Đăng Nhập</h4>

            <form action="" method="POST">
                @csrf
                <form action="{{route('login')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control"  placeholder="Địa chỉ Email">
                        @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label>Password:</label>
                        <input type="password" name="password" class="form-control"  placeholder="Mật khẩu" >
                        @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                    <div>
                        <input type="checkbox" name="remember_token"> Nhớ đăng nhập
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100">Login </button>
                    </div>
            
                    @if(session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
                
                    @if(session('errorLogin'))
                        <div class="alert alert-danger">{{session('errorLogin')}}</div>
                    @endif
                <div class="text-center mt-3">
                    <p>Bạn đã chưa có tài khoản? <a href="{{route('register')}}" class="text-primary">Đăng ký</a></p>
                </div>
                {{-- <a href="#" class="google-btn">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" alt="Google Icon">
                    Đăng nhập bằng Google
                </a> --}}
            </form>
        </div>
    </div>
</div>

@endsection


