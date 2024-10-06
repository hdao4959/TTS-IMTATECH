@extends('admin.layout.layout')
@section('title')
    Thêm mới bài viết
@endsection

{{-- @section('script-special')
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
@endsection --}}
@section('content')
    <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Cột 1 -->
            <div class="col-md-6">
                <div class="mt-2">
                    <label for="" class="form-label">Tiêu đề</label>
                    <input type="text" class="form-control" name="title">
                    @error('title')
                        <span class="text-danger">*{{ $message }}</span>
                    @enderror

                </div>
                <div class="mt-2">
                    <label for="" class="form-label">Danh mục</label>
                    <select name="category_id" id="" class="form-control">
                        <option value="">--None--</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div>
                <label for="" class="mt-2">Hình ảnh</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                    <input  id="thumbnail" class="form-control" type="text" name="img_thumbnail">
                </div>
                @error('img_thumbnail')
                    <span class="text-danger">*{{ $message }}</span>
                @enderror
                {{-- <div class="text-center">
                    <img id="holder" class=" mt-2 mb-2 border border-4 img-fluid rounded" src="{{ $post->img_thumbnail }}" alt="">
                </div> --}}
                <div id="holder" style="margin-top:15px;max-height:100px;"></div>


                <div class="mt-2">
                    <label for="" class="form-label">Mô tả</label>
                    <textarea name="description" class="form-control" id="input_description" cols="30" rows="3" maxlength="150"></textarea>
                    <div id="charCount">0/150 ký tự</div>
                    @error('description')
                        <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Cột 2 -->
            <div class="col-md-6">
                {{-- <div class="mt-2">
                    <label for="" class="form-label">Nội dung</label>
                    <textarea name="content" id="editor" class="form-control" rows="10"></textarea>
                    @error('content')
                        <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div> --}}

                <textarea id="my-editor" name="content" class="form-control">{!! old('content', '') !!}</textarea>
                @error('content')
                    <span class="text-danger">*{{ $message }}</span>
                @enderror
                <div class="mt-2">
                    <label for="">Trạng thái</label>
                    <select name="post_status_id" class="form-control" id="">
                        <option value="">--None--</option>
                        @foreach ($post_statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                    @error('post_status_id')
                        <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-md-12 text-center mt-3">
            <button class="btn btn-success">Thêm mới</button>
            <a class="btn btn-secondary" href="{{ route('admin.posts.index') }}">Quay lại</a>
        </div>
    </form>
@endsection

@section('script')
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        // $('#lfm').filemanager('image');

        var route_prefix = "/laravel-filemanager";
        $('#lfm').filemanager('image', {
            prefix: route_prefix
        });

        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };

        CKEDITOR.replace('my-editor', options);

        const input_description = document.getElementById('input_description');
        const charCount = document.getElementById('charCount');

        input_description.addEventListener('input', function() {
            const length = input_description.value.length;
            charCount.textContent = `${length}/150 ký tự`;
            if (length > 255) {
                input_description.value = input_description.value.substring(0, 150);
                charCount.textContent = "150/150 ký tự";
            }
        });




        // ClassicEditor.create(document.querySelector("#editor"));

        // document.querySelector("form").addEventListener("submit", (e) => {
        //     e.preventDefault();
        //     console.log(document.getElementById("editor").value);
        // });
    </script>
@endsection
