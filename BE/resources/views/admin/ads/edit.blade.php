@extends('admin.layout.layout')
@section('title')
    Thêm mới quảng cáo
@endsection
@section('content')
    @if (Session('success'))
        <div class="alert alert-success" role="alert">
            {{ Session('success') }}
        </div>
    @endif
    <form action="{{ route('admin.ads.update', $ad) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row" style="margin-bottom: 30px">
            <div class="col-md-6">
                <label for="title" class="form-label">Tiêu đề (Có thể để trống)</label>
                <input type="text" class="form-control" name="title" value="{{ $ad->title }}">
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="link" class="form-label">Đường dẫn</label>
                <input type="text" class="form-control" name="link" value="{{ $ad->link }}">
                @error('link')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row" style="margin-bottom: 30px">
            <div class="col-md-6">
                <label for="content" class="form-label">Nội dung (Có thể để trống)</label>
                <textarea type="text" cols="30" rows="5" class="form-control" name="content" value="{{ $ad->content }}"></textarea>
                @error('content')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="role" class="form-label">Hiển thị trong bài viết (Có thể để trống)</label>
                <br>
                <select class="form-select" name="post_id">
                    <option value="">Chọn trạng thái</option>
                    @foreach ($posts as $post)
                        <option value="{{ $post->id }}"@if ($post->id == $ad->post_id) selected @endif>
                            {{ $post->title }}</option>
                    @endforeach
                </select>
                @error('post_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </div>
        <div class="row" style="margin-bottom: 30px">
            <div class="col-md-6">
                <label for="image" class="form-label">Ảnh</label>
                <input type="file" class="form-control" id="image" name="img_thumbnail" onchange="previewImage()">
                <img class="img-fluid mr-3" id="image-preview" style="max-width: 100px; margin-top: 10px"
                    src="{{ asset('storage/' . $ad->img_thumbnail) }}" alt="Chưa cập nhật img_thumbnail">
                @error('img_thumbnail')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.ads.index') }}"><button type="reset" class="btn btn-light">List Ad</button></a>
    </form>

    <script>
        function previewImage() {
            var input = document.getElementById('image');
            var preview = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = "{{ asset('storage/' . $ad->img_thumbnail) }}";
            }
        }
    </script>
@endsection
