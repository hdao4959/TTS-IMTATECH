@extends('client.layout.layout')
@section('title')
    Post Detail
@endsection
@section('content')
    <div class="row">
        {{-- Khu vực bên trái --}}
        <div class="left col-md-8">
            <h1>{{ $post->title }}</h1>
            <p>{{ $post->description }}</p>

            <div class="d-flex align-items-center justify-content-between p-3 rounded">
                <!-- Avatar Section -->
                <div class="flex-shrink-0 me-3">
                    <img src="{{ Storage::url($post->user->avatar) }}" class="rounded-circle border" alt=""
                        style="width: 50px; height: 50px; object-fit: contain;">
                </div>

                <!-- User Info Section -->
                <div class="flex-grow-1">
                    <span class="fw-bold d-block">{{ $post->user->name }}</span>
                    <span class="text-muted d-block">{{ $post->user->role->name }}</span>
                    <span class="text-muted">{{ $post->created_at->format('d M, Y') }}</span>
                </div>

                <!-- Share Icon Section -->
                <div class="text-center">
                    <i class="fa-solid fa-share-nodes fa-lg"></i>
                </div>
            </div>


            <div class="content">
                @php
                    $img = $post->img_thumbnail;
                    if (!str_contains($post->img_thumbnail, 'http')) {
                        $img = Storage::url($post->img_thumbnail);
                    }
                @endphp
                <img src="{{ $img }}" width="100%" alt="">

                <div class="mt-2">
                    <p>{{ $post->description }}</p>
                    <p>{{ $post->content }}</p>
                </div>
            </div>

            <div>

                <h3>Bình luận</h3>
                <form action="{{ route("comment.store") }}" method="POST">
                    @csrf
                    <textarea style="width:100%" name="content" placeholder="Nhập bình luận của bạn" required></textarea>
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <input type="hidden" name="user_id" value="1">
                    <button type="submit" class="btn btn-warning">Gửi bình luận</button>
                </form>

                {{-- Danh sách các bình luận --}}
                <div class="mt-2">
                    {{-- Duyệt qua tất cả các bình luận --}}
                    @foreach ($comments as $item)
                      @include('client.comment', ['comment' => $item] )
                    @endforeach
                </div>
            </div>


        </div>




        {{-- Khu vực bên phải --}}
        <div class="right col-md-4">
            <h4>Trending Posts</h4>
            @php
                $maxLengthTitle = 30;
                $maxLengthDescription = 20;
            @endphp
            @foreach ($postsHot as $item)
                <div class="d-flex mt-2" style=" border:1px; width:100%">
                    <div style="width:40%">
                        @php
                            $img_post_hot = $item->img_thumbnail;
                            if (!str_contains($item->img_thumbnail, 'http')) {
                                $img_post_hot = Storage::url($item->img_thumbnail);
                            }
                        @endphp
                        <img src="{{ $img_post_hot }}" style="object-fit: contain; width:100%" alt="">
                    </div>
                    <div class="mx-2" style="width:60%">
                        <h6 style="font-weight:500">{{ Str::substr($item->title, 0, $maxLengthTitle) . '...' }}</h6>
                        <span>{{ Str::substr($item->description, 0, $maxLengthDescription) . '...' }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
