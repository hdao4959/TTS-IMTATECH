@extends('client.layout.layout')
@section('title')
    Post Detail
@endsection
@section('style')
<style>
  #tablet_social {
    cursor: pointer;
    position: fixed;
    bottom: 50%;
    left: 2%;
    width: 40px;
    height: 80px;
    background-color: #ffffff;
    border: 1px solid gray;
    border-radius: 10px;
}

    #icon_comment{
        cursor: pointer;
    }
    #icon_comment :hover {
        color: orange;
    }
</style>
@endsection
@section('content')

    <div class="row">
        {{-- Khu vực bên trái --}}
        <div class="left col-md-8">

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
                {{-- <div class="text-center" style="position: relative; display: inline-block;">
                    <i id="icon_social" class="fa-solid fa-share-nodes fa-lg" style="cursor: pointer;"></i>
                    <a id="icon_share_facebook" style="display:none; opacity: 0; position: absolute; left: -40px" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(env('APP_URL'). '/post/' . $post->slug) }}" target="_blank" class="btn">
                        <i class="fa-brands fa-facebook fa-lg"></i>
                    </a>
                </div> --}}
            </div>


            <div class="content">
            <h3>{{ $post->title }}</h3>

                @php
                    $img = $post->img_thumbnail;
                    if (!str_contains($post->img_thumbnail, 'http')) {
                        $img = Storage::url($post->img_thumbnail);
                    }
                @endphp
                <img src="{{ $img }}" width="100%" alt="">

                <div class="mt-2">
                    <p>{{ $post->description }}</p>
                    <p>{!! $post->content !!}</p>
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
        <div class="right  col-md-4">
            <h4>Phổ biến</h4>
            {{-- <div class="card">
                @php 
                $maxLengthTitle = 30;
                $maxLengthDescription = 20;
            @endphp
            @foreach ($postsHot as $item)
                <div class="d-flex mt-1 mb-1" style=" border:1px; width:100%">
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
            </div> --}}
            <table class="table table-hover">
            <tbody>
    
                @foreach ($popularPosts as $popularPost)
                <tr>
                    <td>
                        <a  href="{{ route('post.detail', $popularPost->slug) }}" class="text-decoration-none text-body px-0">
                            <div class="row">
                                <div class="col-12 col-sm-5 ">
                                    <img class="img-fluid border" 
                                         src="{{ str_contains($popularPost->img_thumbnail, 'http') ? $popularPost->img_thumbnail : Storage::url($popularPost->img_thumbnail) }}" 
                                         alt="{{ $popularPost->title }}">
                                </div>
                                <div class="col col-sm-7">
                                    <span>{{ $popularPost->title }}</span>
                                    <p class="text-muted">{{ $popularPost->created_at->format('d M, Y') }}</p>
                                </div>
                            </div>
                        </a>
                    </td>
                       
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>

    <div id="tablet_social" class="text-center">
        <a title="Chia sẻ lên fb" id="icon_share_facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(env('APP_URL'). '/post/' . $post->slug) }}" ><i  class="fa-brands fa-facebook fa-lg"></i></a>
        <a title="Bình luận" id="icon_comment"><i class="fa-regular fa-message"></i></a><br>
        <a title="Quay lại" href="{{ route('home') }}"><i class="fa-solid fa-arrow-left"></i></a>
    </div>
   
@endsection

@section('script')
    <script>
        const tablet_social = document.querySelector('#tablet_social');
        window.onscroll = function() {
            if(window.scrollY > 500){
                tablet_social.style.display = 'block'
            }else{
                tablet_social.style.display = 'none'
            }
            
        }
       
        
        
   
    </script>
@endsection