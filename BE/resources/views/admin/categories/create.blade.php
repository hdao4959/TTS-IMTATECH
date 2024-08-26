@extends('admin.layout.layout')
@section('title')
    Thêm mới danh mục
@endsection
@section('content')
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
            
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" checked>
            <label class="form-check-label" for="is_active">Kích hoạt</label>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@endsection
