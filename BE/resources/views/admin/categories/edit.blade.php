@extends('admin.layout.layout')
@section('title')
    Thêm mới danh mục
@endsection
@section('content')
    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{ $category->name }}">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                {{ $category->is_active ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Kích hoạt</label>
        </div>

        <button type="submit" class="btn btn-warning mb-3">Cập nhật</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-info mb-3 ms-3">Danh sách</a>
    </form>
@endsection
