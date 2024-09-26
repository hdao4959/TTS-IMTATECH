@extends('client.layout.layout')
@section('title')
    Add new post
@endsection

@section('content')
    <div class="container">
        <div class="row main">
            <div class="col-md-8 left">
                <h1>Tin chính</h1>
                <div class="row head my-1">
                    <div class="col-md-8 px-0 ">
                        <img style="width:100%" src={{ $mainPosts[0]->img_thumbnail }} alt="">
                    </div>
                    <div class="col-md-4 bg-light">
                        <h4>
                            {{ $mainPosts[0]->title }}
                        </h4>
                        <span>{{ $mainPosts[0]->description }}</span><br>
                        <span class="text-secondary">{{ $mainPosts[0]->updated_at }}</span>
                    </div>
                </div>
                <hr>
                <div class="row my-2">
                    @php
                        $number = 0;
                    @endphp
                    @foreach ($mainPosts->skip(1) as $mainPost)
                        @php
                            $number++;
                            if ($number > 3) {
                                break;
                            }
                        @endphp
                        <div class="col-md-4 ">
                            <h5>{{ $mainPost->title }}</h5>
                            <span>{{ $mainPost->description }}</span>
                        </div>
                    @endforeach
                </div>
                <hr>

                <div class="row">
                    @foreach ($tags as $tag)
                     <a class=" mx-1 col-md-2 btn btn-outline-primary rounded-pill" href="">{{ $tag->name }}</a>
                    @endforeach
                </div>
            </div>


            <div class="col-md-4 right ">
                <h1>Phổ biến</h1>
                <div class="card">
                    @foreach ($mainPosts->skip(1) as $mainPost)
                        <a href="{{ route('post.detail', $mainPost->slug) }}" class="nav-link ">
                            <div class="row">
                                <div class="col-12 col-sm-5 px-0">
                                    <img class="img-fluid"
                                        src="{{ str_contains($mainPost->img_thumbnail, 'http') ? $mainPost->img_thumbnail : Storage::url($mainPost->img_thumbnail) }}"
                                        alt="{{ $mainPost->title }}">
                                </div>
                                <div class="col col-sm-7 px-0">
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
