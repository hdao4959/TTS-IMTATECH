@extends('admin.layout.layout')
@section('title')
    Cập nhật User
@endsection
@section('content')
    @if (Session('success'))
        <div class="alert alert-success" role="alert">
            {{ Session('success') }}
        </div>
    @endif
    <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row" style="margin-bottom: 30px">
            <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row" style="margin-bottom: 30px">
            <div class="col-md-6">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" name="description" value="{{ $user->description }}">
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" name="password" value="{{ $user->password }}">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row" style="margin-bottom: 30px">
            <div class="col-md-6">
                <label for="image" class="form-label">Avatar</label>
                <input type="file" class="form-control" id="image" name="avatar" onchange="previewImage()">
                <img class="img-fluid mr-3" id="image-preview" style="max-width: 100px; margin-top: 10px"
                    src="{{ asset('storage/' . $user->avatar) }}" alt="Chưa cập nhật avatar">
                @error('avatar')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" name="role_id">
                    <option value="">Select a role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" @if ($user->role_id == $role->id) selected @endif>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="reset" class="btn btn-light">Reset Button</button>
    </form>

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
                preview.src = "{{ asset('storage/' . $user->avatar) }}";
            }
        }
    </script>
@endsection
