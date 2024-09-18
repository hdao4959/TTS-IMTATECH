@php
    // Xử lí ảnh với các hình ảnh lấy từ nguồn khác
    $img = $comment->user->avatar;
    if (!str_contains($img, 'http')) {
        $img = Storage::url($img);
    }
@endphp
{{-- Thành phần của từng bình luận --}}
<div class="flex-shrink-0 me-3 d-flex align-items-center">
    <img src="{{ $img }}" class="rounded-circle border" alt=""
         style="width: 50px; height: 50px; object-fit: contain;">
    <div class="ms-2">
        {{ $comment->user->name }}
        {{-- Hiển thị "Tag- tác giả" nếu tác giả bình luận --}}
        @if ($comment->user->id == $post->user->id)
            <span class="text-danger">Tác giả</span>
        @endif
    </div>

    {{-- Nút ba chấm để hiển thị nút xóa --}}
    <div class="dropdown ms-auto">
        <button class="btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
            &#x22EE; {{-- Dấu ba chấm --}}
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li>
                <form action="{{ route('comment.delete', $comment->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger">Delete</button>
                </form>
            </li>
        </ul>
    </div>
</div>

{{-- Nội dung bình luận --}}
<h5 class="mx-5">{{ $comment->content }}</h5>

{{-- Dòng "Trả lời" --}}
<div class="mx-5">
    <a href="javascript:void(0)" class="reply-link text-primary" onclick="toggleReplyForm({{ $comment->id }})">Trả lời</a>
</div>

{{-- Form phản hồi bình luận (ẩn đi ban đầu) --}}
<div id="reply-form-{{ $comment->id }}" class="mx-5 reply-form" style="display: none;">
    <form action="{{ route('comment.store') }}" method="POST">
        @csrf
        <textarea style="width:80%" name="content" placeholder="Nhập bình luận của bạn" required></textarea>
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
        <input type="hidden" name="user_id" value="1">
        <button type="submit" class="btn btn-danger">Gửi bình luận</button>
    </form>
</div>

{{-- Hiển thị các phản hồi bình luận --}}
@if (isset($comment->replies))
    @foreach ($comment->replies as $reply)
        <div class="mx-5">
            @include('client.comment', ['comment' => $reply])
        </div>
    @endforeach
@endif

<script>
    // Hàm để ẩn/hiện form trả lời
    function toggleReplyForm(commentId) {
        var replyForm = document.getElementById('reply-form-' + commentId);
        if (replyForm.style.display === 'none') {
            replyForm.style.display = 'block';
        } else {
            replyForm.style.display = 'none';
        }
    }
</script>
