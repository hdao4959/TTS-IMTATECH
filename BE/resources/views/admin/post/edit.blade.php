@extends('admin.layout.layout')
@section('title')
    Chỉnh sửa bài viết
@endsection
@section('style')
    <style>
        div.ck-editor__editable {
            min-height: 200px;
        }
        #charCount {
            font-size: 0.9em;
            color: #555;
        }
    </style>
@endsection
@section('script-special')
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
@endsection
@section('content')
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
    <form action="{{ route('admin.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PATCH")
        <div class="row">
            <!-- Cột 1 -->
            <div class="col-md-6">
                <div class="mt-2">
                    <label for="" class="form-label">Tiêu đề</label>
                    <input type="text" class="form-control" name="title" value="{{ $post->title }}">
                    @error('title')
                    <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-2">
                    <label for="" class="form-label">Slug</label>
                    <input type="text" class="form-control" disabled value="{{ $post->slug }}">
                </div>
                <div class="mt-2">
                    <label for="" class="form-label">Danh mục</label>
                    <select name="category_id" id="" class="form-control">
                        @foreach ($categories as $item)
                            <option @selected($item->id == $post->category_id) value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-2">
                    <label for="" class="form-label">Hình ảnh</label>
                    <input type="file" name="img_thumbnail" id="" class="form-control">
                    @if (isset($post->img_thumbnail))
                        @php
                            if (str_contains($post->img_thumbnail, 'http')) {
                                $img = $post->img_thumbnail;
                            } else {
                                $img = Storage::url($post->img_thumbnail);
                            }
                        @endphp
                        <img class="mt-2 mb-2 border border-4 img-fluid rounded" src="{{ $img }}" width="100%"
                            alt="">
                    @endif
                </div>

            </div>

            <!-- Cột 2 -->
            <div class="col-md-6">
                <div class="mt-2">
                    <label for="" class="form-label">Mô tả</label>
                    <textarea name="description" class="form-control" id="input_description" cols="30" rows="3" maxlength="150">{{ $post->description }}</textarea>
                    <div id="charCount">0/150 ký tự</div>
                    @error('description')
                <span class="text-danger">*{{ $message }}</span>
                @enderror
                </div>
                <div class="mt-2">
                    <label for="" class="form-label">Nội dung</label>
                    <textarea name="content" id="editor" class="form-control" rows="10">{{ $post->content }}</textarea>
                    @error('content')
                    <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-2">
                    <label for="">Trạng thái</label>
                    <select name="post_status_id" class="form-control" id="">
                        @foreach ($post_statuses as $status)
                            <option @selected($status->id  == $post->post_status_id) value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 mt-3">
                    <button class="btn btn-warning" type="submit">Chỉnh sửa</button>
                    <a class="btn btn-secondary" href="{{ route('admin.posts.index') }}">Quay lại</a>
                </div>
            </div>

        </div>
    </form>
@endsection

@section('script')
    <script>

        const input_description = document.getElementById('input_description');
        const charCount = document.getElementById('charCount');
        const length = input_description.value.length;
        charCount.textContent = `${length}/150 ký tự`;
        input_description.addEventListener('input', function() {
            const length = input_description.value.length;
            charCount.textContent = `${length}/150 ký tự`;
            if (length > 255) {
                input_description.value = input_description.value.substring(0, 150);
                charCount.textContent = "150/150 ký tự";
            }
        });


        ClassicEditor.create(document.querySelector("#editor"));

        // document.querySelector("form").addEventListener("submit", (e) => {
        //     e.preventDefault();
        //     console.log(document.getElementById("editor").value);
        // });
    </script>
@endsection
