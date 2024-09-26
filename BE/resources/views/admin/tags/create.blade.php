@extends('admin.layout.layout')
@section('title')
    Thêm mới Tag
@endsection
@section('content')
    <form action="{{ route('admin.tags.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên tag</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
            @error('name')
            <span class="text-danger">*{{ $message }}</span>
            @enderror
        </div>
        
        {{-- <div class="mb-3">
            <label for="slug" class="form-label">Đường dẫn</label>
            <input type="text" class="form-control" id="slug" name="slug" required value="{{ old('slug') }}">
            @error('slug')
            <span class="text-danger">*{{ $message }}</span>
            @enderror
        </div> --}}
        
        <button type="submit" class="btn btn-primary">Thêm mới</button>
        <a class="btn btn-info" href="{{ route('admin.tags.index') }}">Quay lại</a>
    </form>
@endsection