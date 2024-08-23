@extends('admin.layout.layout')
@section('title')
    Danh sách bài viết
@endsection
@section('content')
<button class="btn btn-success">Thêm mới</button>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Tiêu đề</th>
                <th>Hình ảnh</th>
                <th>Danh mục</th>
                <th>Lượt xem</th>
                <th>Chi tiết | Sửa | Xoá</th>
            </tr>
        </thead>
        <tbody>
            @php
                $row = 0;
            @endphp
            @foreach ($posts as $post)
                @php
                    ++$row;
                @endphp
                <tr>
                    <td>{{ $row  }}</td>
                    <td>{{ Str::limit($post->title, 50, '...') }}</td>
                    <td><img src="{{ $post->img_thumbnail }}" width="100" alt=""></td>
                    <td>{{ $post->category->name }}</td>
                    <td>{{ $post->view }}</td>
                    <td class="">
                        <button class="btn btn-sm btn-secondary">Chi tiết</button>
                        <button class="btn btn-sm btn-warning">Sửa</button>
                        <button class="btn btn-sm btn-danger">Xoá</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}
@endsection