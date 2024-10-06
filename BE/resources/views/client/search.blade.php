@extends('client.layout.layout')
@section('title')
    Kết quả tìm kiếm
@endsection

@section('content')
    <div class="row"> 
        <div class="col-md-8">
            <h4>Có {{ $posts->count() }}  kết quả tìm kiếm cho: {{ $keyword }}</h4>
            <div class="row">
                @foreach ($posts as $post)
                @php
                    $img_thumbnail = $post->img_thumbnail;
                    if(!str_contains($post->img_thumbnail, 'http') && Storage::exists($post->img_thumbnail) ){
                        $img_thumbnail = Storage::url($post->img_thumbnail);
                    }
                @endphp
                <div class="col-md-4">
                    <div>
                        <img class="img-fluid" src="{{ $img_thumbnail }}" alt="">
                    </div>
                    <h6>{{ $post->title }}</h6>
                </div>
                @endforeach
            </div>
        </div>
            {{-- <div class="col-md-4">
                <h4>Bài viết xem nhiều</h4>
                @foreach ($posts as $post)
                <a href="{{ route('post.detail', $post->slug) }}" class="nav-link px-0">
                    <div class="row">
                        <div class="col-12 col-sm-5 ">
                            <img class="img-fluid" 
                                src="{{ str_contains($post->img_thumbnail, 'http') ? $post->img_thumbnail : Storage::url($post->img_thumbnail) }}" 
                                alt="{{ $post->title }}">
                        </div>
                        <div class="col col-sm-7">
                            <span>{{ $post->title }}</span>
                            <p class="text-muted">{{ $post->created_at->format('d M, Y') }}</p>
                        </div>
                    </div>
                </a>
                
                @endforeach
            </div> --}}
    </div>
@endsection