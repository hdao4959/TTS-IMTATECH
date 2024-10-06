@extends('client.layout.layout')
@section('title')
    Add new post
@endsection

@section('content')
    <div class="container">
        <div class="row main">
            <div class="col-md-8 left">
                <h1>Mới nhất</h1>
                <a href="{{ route('post.detail', $mainPosts[0]->slug) }}" class="text-decoration-none text-dark row head my-1">
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
                </a>
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
                        <a href="{{ route('post.detail', $mainPost->slug) }}" class="col-md-4 text-decoration-none text-body">
                            <h5>{{ $mainPost->title }}</h5>
                            <span>{{ $mainPost->description }}</span>
                        </a>
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
                {{-- <div class="card">
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
        
    </div>
@endsection
