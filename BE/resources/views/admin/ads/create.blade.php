@extends('admin.layout.layout')
@section('title')
    Thêm mới quảng cáo
@endsection
@section('content')
    <form action="{{ route('admin.ads.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row" style="margin-bottom: 30px">
            <div class="col-md-6">
                <label for="title" class="form-label">Tiêu đề (Có thể để trống)</label>
                <input type="text" class="form-control" name="title" value="{{old('title')}}">
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="link" class="form-label">Đường dẫn</label>
                <input type="text" class="form-control" name="link" value="{{old('link')}}">
                @error('link')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row" style="margin-bottom: 30px">
            <div class="col-md-6">
                <label for="content" class="form-label">Nội dung (Có thể để trống)</label>
                <textarea type="text" cols="30" rows="5" class="form-control" name="content" value="{{old('content')}}"></textarea>
                @error('content')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
           
            <div class="col-md-6">
                <label for="role" class="form-label">Bài viết (Có thể để trống)</label>
                <br>
                <select class="form-select" name="post_id">
                    <option value="">Chọn trạng thái</option>
                    @foreach ($posts as $post)
                        <option value="{{ $post->id }}"@if($post->id == old('post_id')) selected @endif>{{ $post->title }}</option>
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
                <input type="file" class="form-control" name="img_thumbnail" id="image-input" onchange="previewImage()">
                <img id="image-preview" src="#" alt="Preview"
                    style="max-width: 100px; display: none; margin-top: 10px">
                @error('img_thumbnail')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
           
            
        </div>
        <button type="submit" class="btn btn-primary">Add new</button>
        <button type="reset" class="btn btn-light">Reset Button</button>
    </form>

    <script>
        function previewImage() {
            var input = document.getElementById('image-input');
            var preview = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }
    </script>
@endsection
