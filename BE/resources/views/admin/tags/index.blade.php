@extends('admin.layout.layout')
@section('title')
    Danh sách Tag
@endsection
@section('content')
    <a href="{{ route('admin.tags.create') }}" class="btn btn-success">Thêm mới</a>
    @if(session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
@endif
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên Tag</th>
                <th>Đường dẫn</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $row = 0;
            @endphp
            @foreach ($tags as $tag)
                @php
                    ++$row;
                @endphp
                <tr>
                    <td>{{ $row }}</td>
                    <td>{{ $tag->name }}</td>
                    <td>{{ $tag->slug }}</td>
                    <td class="">
                        <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $tags->links() }}
@endsection