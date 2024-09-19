@extends('admin.layout.layout')
@section('title')
    Chỉnh sửa Tags
@endsection
@section('content')
@if(session('success'))
<div class="alert alert-success">{{session('success')}}</div>
@endif
    <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Tên tag</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{$tag->name}}">
            @error('name')
            <span class="text-danger">*{{ $message }}</span>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="slug" class="form-label">Đường dẫn</label>
            <input type="text" class="form-control" id="slug" name="slug" required value="{{$tag->slug}}">
            @error('slug')
            <span class="text-danger">*{{ $message }}</span>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-warning mb-3">Cập nhật</button>
        <a href="{{ route('admin.tags.index') }}" class="btn btn-info mb-3 ms-3">Danh sách</a>
    </form>
@endsection