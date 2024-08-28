@extends('admin.layout.layout')
@section('title')
    Chi tiết bài viết
@endsection
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            @php
                if (str_contains($post->img_thumbnail, 'http')) {
                    $img_thumbnail = $post->img_thumbnail;
                } else {
                    $img_thumbnail = Storage::url($post->img_thumbnail);
                }
            @endphp

            <img src="{{ $img_thumbnail }}" class="img-fluid rounded " alt="{{ $img_thumbnail }}">
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $post->title }}</h4>
                    <h6 class="card-title text-secondary">{{ $post->description }}</h6>
                    
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <b>Slug:</b> <span class="badge bg-warning   text-dark">{{ $post->slug }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Danh mục:</b> <span class="badge bg-info text-dark">{{ $post->category->name }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Tác giả:</b> {{ $post->user->name }}
                        </li>
                        <li class="list-group-item">
                            <b>Ngày đăng:</b> {{ $post->created_at->format('d/m/Y H:i') }}
                        </li>
                        <li class="list-group-item">
                            <b>Lượt xem:</b> {{ $post->view }}
                        </li>
                        <li class="list-group-item">
                            <b>Trạng thái bài viết:</b> <span class="badge bg-success">{{ $post->post_status->name }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <div class="content" style="text-indent:2em;">
                {!! $post->content !!}
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <a class="btn btn-warning" href="{{ route('admin.posts.edit', $post->id) }}">Sửa</a>
            <a class="btn btn-secondary" href="{{ route('admin.posts.index') }}">Quay lại</a>
        </div>
    </div>
</div>

@endsection
