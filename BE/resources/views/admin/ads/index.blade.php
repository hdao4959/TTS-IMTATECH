@extends('admin.layout.layout')
@section('title')
    Danh sách quảng cáo
@endsection
@section('content')
    <style>
        .table {
            width: 100%;
            table-layout: auto;
        }

        .table th,
        .table td {
            padding: 8px;
            text-align: left;
        }

        .table th:not(:first-child),
        .table td:not(:first-child) {
            width: 30%;
            overflow-wrap: break-word;
            word-wrap: break-word;
            hyphens: auto;
        }
    </style>
    @if (Session('success'))
        <div class="alert alert-success" role="alert">
            {{ Session('success') }}
        </div>
    @endif
    <a href="{{ route('admin.ads.create') }}" class="btn btn-primary">Thêm mới</a>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Link</th>
                <th>Ảnh</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $row = 0;
            @endphp
            @foreach ($ads as $ad)
                @php
                    ++$row;
                @endphp
                <tr>
                    <td>{{ $row }}</td>
                    <td>{{ $ad->link }}</td>
                    <td><img src="{{ Storage::Url($ad->img_thumbnail) }}" width="100px" height="100px"></td>
                    <td>
                        <a style="margin-right: 2px" href="ad/{{ $ad->id }}"
                            class="btn btn-sm btn-{{ $ad->is_visible ? 'danger' : 'success' }}">
                            {{ $ad->is_visible ? 'Ẩn' : 'Hiển thị' }}
                        </a>
                        <button class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#userDetailModal{{ $ad->id }}">Chi tiết</button>
                        <a href="{{ route('admin.ads.edit', $ad) }}"> <button
                                class="btn btn-sm btn-warning">Sửa</button></a>
                        <form class="d-inline-block" action="{{ route('admin.ads.destroy', $ad) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $ads->links() }}
    <!-- Modal -->
    @foreach ($ads as $ad)
        <div class="modal fade" id="userDetailModal{{ $ad->id }}" tabindex="-1"
            aria-labelledby="userModalLabel{{ $ad->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="post">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="userModalLabel{{ $ad->id }}">Chi tiết người dùng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           @if ($ad->title)
                           <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control" name="title" value="{{ $ad->title }}"
                                readonly>
                        </div>
                           @endif
                          @if ($ad->content)
                          <div class="mb-3">
                            <label for="description" class="form-label">Nội dung</label>
                            <textarea class="form-control" name="content" rows="3" readonly>{{ $ad->content }}</textarea>
                        </div>
                          @endif
                            <div class="mb-3">
                                <label for="password" class="form-label">link</label>
                                <input type="text" class="form-control" name="link" value="{{ $ad->link }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="avatar" class="form-label me-5">Ảnh</label>
                                <img class="img-fluid mr-3" style="max-width: 100px; height: 100px"
                                    src="{{ asset('storage/' . $ad->img_thumbnail) }}">
                            </div>
                            @php
                                $is_visible = ['0' => 'Ẩn', '1' => 'Hiển thị'];
                            @endphp
                            <div class="mb-3">
                                <label for="role" class="form-label">Trạng thái</label>
                                <input type="text" class="form-control" name="is_visible"
                                    value="{{ $is_visible[$ad->is_visible] }}" readonly>
                            </div>

                            @if ($ad->post_id)
                            <div class="mb-3">
                                <label for="role" class="form-label">Hiển thị trong bài viết</label>
                                <input type="text" class="form-control" name="post_id"
                                    value="{{ $ad->post->title}}" readonly>
                            </div>
                            @endif

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
