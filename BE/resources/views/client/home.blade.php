@extends('client.layout.layout')
@section('title')
    Add new post
@endsection

@section('content')
    <div class="container">
        <h1>Tin chính</h1>
        <div>
            <div class="row">
                <div class="col-md-7 p-0">
                    <a href="{{ route('post.detail', $mainPosts[0]->slug) }}" class="nav-link">
                        <h3>
                            {{ $mainPosts[0]->title }}
                        </h3>
                        <img class="img-fluid"
                            src="{{ str_contains($mainPosts[0]->img_thumbnail, 'http') ? $mainPosts[0]->img_thumbnail : Storage::url($mainPosts[0]->img_thumbnail) }}"
                            alt="">
                        <p>{{ $mainPosts[0]->description }}</p>
                    </a>
                </div>

                <div class="col-md-5 p-0">
                    @foreach ($mainPosts->skip(1) as $mainPost)
                    <a href="{{ route('post.detail', $mainPost->slug) }}" class="nav-link ">
                        <div class="row my-2">
                            <div class="col-12 col-sm-5">
                                <img class="img-fluid" 
                                     src="{{ str_contains($mainPost->img_thumbnail, 'http') ? $mainPost->img_thumbnail : Storage::url($mainPost->img_thumbnail) }}" 
                                     alt="{{ $mainPost->title }}">
                            </div>
                            <div class="col col-sm-7 p-0 ">
                                <span>{{ $mainPost->title }}</span>
                                <p class="text-muted">{{ $mainPost->created_at->format('d M, Y') }}</p>
                            </div>
                        </div>
                    </a>
                       
                    @endforeach
                </div>
            </div>
        </div>

       
    </div>
@endsection
