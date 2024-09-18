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
        .title{
            
        }
    </style>

@section('content')
<div class="container mt-5">
    <div class="title mb-5">
        <h2 class="text-dart">Thông tin cá nhân</h2>
        <p>Sau đây là tất cả thông tin chi tiết mà chúng tôi cung cấp cho bạn</p>
    </div>
   
    <div class="row">
        <div class="col-md-4">
            <div class="profile-card text-center d-flex">
                <div><img src="/public/storage/images/Ybw4YLafPWt4Iuh83UmME4XTv8nelNZ51WGJO4sr.jpg" class="profile-image"></div>
                <div class="text-start ms-4">
                    <h5>Trường PX</h5>
                    <p>user999@gmail.com</p>
                    <a href="#" class="btn btn-outline-primary">Cập nhật ảnh hồ sơ</a>
                </div>
            </div>
            <div class="profile-card">
                <h5>Ngôn ngữ</h5>
                <p><strong>Tiếng anh - Hoa Kỳ</strong></p>
                <a href="#" class="btn btn-outline-primary">Cập nhật ngôn ngữ</a>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="profile-card">
                <h5>Chi tiết của bạn</h5>
                <p><strong>Tên:</strong> Trường</p>
                <p><strong>Họ:</strong> PX</p>
                <p><strong>Tên ưa thích:</strong> Trường</p>
                <p><strong>Năm sinh:</strong> -----</p>
                <p><strong>Giới tính:</strong> Nam</p>
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#profileModal">Cập nhật thông tin cá nhân</a>
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
                <form>
                    <div class="mb-3">
                        <label for="ten" class="form-label">Tên</label>
                        <input type="text" class="form-control" id="ten" value="Trường">
                    </div>
                    <div class="mb-3">
                        <label for="ho" class="form-label">Họ</label>
                        <input type="text" class="form-control" id="ho" value="PX">
                    </div>
                    <div class="mb-3">
                        <label for="tenua" class="form-label">Tên ưa thích</label>
                        <input type="text" class="form-control" id="tenua" value="Trường">
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Giới tính</label>
                        <select class="form-select" id="gender">
                            <option value="male" selected>Nam</option>
                            <option value="female">Nữ</option>
                            <option value="other">Khác</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="birthyear" class="form-label">Năm sinh</label>
                        <input type="text" class="form-control" id="birthyear" placeholder="XXXX">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary">Lưu cập nhật</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection