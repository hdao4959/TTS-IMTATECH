@extends('admin.layout.layout')
@section('title')
    Danh sách bài viết
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin.posts.create') }}" class="btn btn-success">Thêm mới</a>
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
                    <td>{{ $row }}</td>
                    <td>{{ Str::limit($post->title, 50, '...') }}</td>
                    <td>
                        @php
                            if (str_contains($post->img_thumbnail, 'http')) {
                                $img_thumbnail = $post->img_thumbnail;
                            } else {
                                $img_thumbnail = Storage::url($post->img_thumbnail);
                            }
                        @endphp
                        <img src="{{ $img_thumbnail }}" width="100" alt="">
                    </td>
                    <td>{{ $post->category->name }}</td>
                    <td>{{ $post->view }}</td>
                    <td class="">
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-sm btn-secondary">Chi tiết</a>
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <button type="submit" onclick="return confirm('Bạn có chắc muốn xoá không?')" class="btn btn-sm btn-danger">Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}
@endsection
