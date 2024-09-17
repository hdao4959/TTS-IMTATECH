@extends('client.layout.layout')
@section('title')
    Add new post
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
    <h2>Add new post</h2>
    <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="post_status_id" value="2">
        <input type="hidden" name="use_id" value="2">
        <div class="row ">
            <div class="col-md-8">
                <div>
                    <label for="" class="form-label">Tiêu đề</label>
                    <input type="text" name="title" class="form-control">
                    @error('title')
                    <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-2">
                    <label for="" class="form-label">Mô tả</label>
                    <textarea name="description" class="form-control" id="input_description" cols="30" rows="3" maxlength="150"></textarea>
                    <div id="charCount">0/150 ký tự</div>
                    @error('description')
                    <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-2">
                    <div class="mt-2">
                        <label  for="" class="form-label">Nội dung</label>
                        <textarea name="content" id="editor" class="form-control" rows="10"></textarea>
                        @error('content')
                        <span class="text-danger">*{{ $message }}</span>
                        @enderror
                    </div>
                
                </div>
            </div>
            <div class="col-md-4">
                <div>
                    <label for="" class="form-label">Ảnh thumbnail</label>
                    <input type="file" name="img_thumbnail" class="form-control" id="">
                    @error('img_thumbnail')
                    <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="" class="form-label">Danh mục</label>
                    <select class="form-control" name="category_id" id="">
                        <option value="">----None----</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-success">Đăng bài</button>
            <button class="btn btn-warning" type="reset">Reset</button>
            <a href="" class="btn btn-secondary"> Quay lại</a>
        </div>
    </form>
@endsection

@section('script')
<script>

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


    ClassicEditor.create(document.querySelector("#editor"));

    // document.querySelector("form").addEventListener("submit", (e) => {
    //     e.preventDefault();
    //     console.log(document.getElementById("editor").value);
    // });
</script>
@endsection