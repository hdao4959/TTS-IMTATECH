@extends('admin.layout.layout')
@section('title')
    Danh sách User
@endsection
@section('content')
    @if (Session('success'))
        <div class="alert alert-success" role="alert">
            {{ Session('success') }}
        </div>
    @endif
    <a href="{{ route('admin.users.create') }}"><button class="btn btn-primary">Thêm mới</button></a>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Avatar</th>
                <th>Email</th>
                <th>Role</th>
                <th>Acction</th>
            </tr>
        </thead>
        <tbody>
            @php
                $row = 0;
            @endphp
            @foreach ($users as $user)
                @php
                    ++$row;
                @endphp
                <tr>
                    <td>{{ $row }}</td>
                    <td>{{ $user->name }}</td>
                    <td><img src="{{ asset('storage/' . $user->avatar) }}" width="90px" height="110px"
                            style="object-fit: cover" alt="Chưa cập nhật ảnh"></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>
                        <a style="margin-right: 2px" href="user/{{$user->id}}" class="btn btn-sm btn-{{ $user->is_active ? 'success' : 'danger'}}">
                            {{ $user->is_active ? 'Enabled' : 'Disabled' }}
                           </a>
                        <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#userDetailModal{{$user->id}}">Chi tiết</button>
                        <a href="{{ route('admin.users.edit', $user) }}"> <button
                                class="btn btn-sm btn-warning">Sửa</button></a>
                        <form class="d-inline-block" action="{{ route('admin.users.destroy', $user) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
    <!-- Modal -->
    @foreach ($users as $user)
    <div class="modal fade" id="userDetailModal{{$user->id}}" tabindex="-1" aria-labelledby="userModalLabel{{$user->id}}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
             <form action="" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel{{$user->id}}">Chi tiết người dùng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên</label>
                        <input type="text" class="form-control" name="name" value="{{$user->name}}" readonly> 
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{$user->email}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="avatar" class="form-label me-5">Avatar</label>
                        <img class="img-fluid mr-3" style="max-width: 100px"
                        src="{{ asset('storage/' . $user->avatar) }}" alt="Chưa cập nhật avatar">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" name="password" value="{{$user->password}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Vai trò</label>
                        <input type="text" class="form-control" name="role" value="{{$user->role->name}}" readonly >
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea class="form-control" name="description" rows="3" readonly>{{$user->description}}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
             </form>
            </div>
        </div>
    </div>
    @endforeach
@endsection
