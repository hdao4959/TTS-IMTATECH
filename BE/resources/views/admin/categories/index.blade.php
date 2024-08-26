@extends('admin.layout.layout')
@section('title')
    Danh sách danh mục
@endsection
@section('content')
    <a href="{{ route('admin.categories.create') }}" class="btn btn-success">Thêm mới</a>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên danh mục</th>
                <th>Đường dẫn</th>
                <th>Trạng thái</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $row = 0;
            @endphp
            @foreach ($categories as $category)
                @php
                    ++$row;
                @endphp
                <tr>
                    <td>{{ $row }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        <span class="{{ $category->is_active ? 'text-success' : 'text-danger' }}">
                            {{ $category->is_active ? 'Kích hoạt' : 'Không kích hoạt' }}
                        </span>
                    </td>
                    <td class="">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
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

    {{ $categories->links() }}
@endsection
