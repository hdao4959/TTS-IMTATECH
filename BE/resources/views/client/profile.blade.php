@extends('client.layout.layout')
@section('title')
    Profile
@endsection
<style>
    body {
        background-color: #f8f9fa;
    }

    .profile-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .profile-image {
        width: 120px;
        height: 130px;
        border-radius: 50%;
        background: #e0e0e0;
        margin-bottom: 15px;
    }

    .title {}
</style>

@section('content')
    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="title mb-5">
            <h2 class="text-dart">Thông tin cá nhân</h2>
            <p>Sau đây là tất cả thông tin chi tiết mà chúng tôi cung cấp cho bạn</p>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="profile-card text-center d-flex">
                    <div>
                        <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('storage/avatars/avatar-mac-dinh.jpg') }}" class="profile-image">
                    </div>
                    <div class="text-start ms-4">
                        <h5>{{ Auth::user()->name }}</h5>
                        <p>{{ Auth::user()->email }}</p>
                        {{-- <a href="#" class="btn btn-outline-primary">Cập nhật ảnh hồ sơ</a> --}}
                    </div>
                </div>
                <div class="profile-card">
                    <a href="#" class="btn btn-outline-primary" id="toggle-password-form">Đổi mật khẩu</a>
                    <div id="password-form" class="mt-3" style="display: none;">
                        <form method="POST" action="{{ route('change-password') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                                <input type="password" class="form-control" id="current_password" name="current_password">
                                @error('current_password')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Mật khẩu mới</label>
                                <input type="password" class="form-control" id="new_password" name="new_password">
                                @error('new_password')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Nhập lại mật khẩu mới</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                @error('confirm_password')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Lưu mật khẩu mới</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="profile-card">
                    <h5>Chi tiết của bạn</h5>
                    <p><strong>Tên:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Năm sinh:</strong> -----</p>
                    <p><strong>Giới tính:</strong> Nam</p>
                    <p><strong>Mô tả: </strong>{{ Auth::user()->description }}</p>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#profileModal">Cập nhật
                        thông tin cá nhân</a>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Cập nhật thông tin cá nhân</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('update-profile') }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="ten" class="form-label">Họ Tên</label>
                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Avatar</label>
                            <input type="file" class="form-control" id="image" name="avatar"
                                onchange="previewImage()">
                            <img class="img-fluid mr-3" id="image-preview" style="max-width: 100px; margin-top: 10px"
                                src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : '#' }}"
                                alt="">
                            @error('avatar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <input type="text" class="form-control" name="description"
                                value="{{ Auth::user()->description }}">
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Lưu cập nhật</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#toggle-password-form').click(function(e) {
                e.preventDefault(); 
                $('#password-form').toggle(); 
            });
        });
    </script>

    <script>
        function previewImage() {
            var input = document.getElementById('image');
            var preview = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = "{{ asset('storage/' . Auth::user()->avatar) }}";
            }
        }
    </script>
@endsection
