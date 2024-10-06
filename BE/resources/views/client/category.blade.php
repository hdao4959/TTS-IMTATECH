@extends('client.layout.layout')
@section('title')
    Add new post
@endsection

@section('content')
    <div class="row"> 
        <div class="col-md-8">
            <h4>{{ $category->name }}</h4>
            <div class="row">
                @foreach ($posts as $post)
                @php
                    $img_thumbnail = $post->img_thumbnail;
                    if(!str_contains($post->img_thumbnail, 'http') && Storage::exists($post->img_thumbnail) ){
                        $img_thumbnail = Storage::url($post->img_thumbnail);
                    }
                @endphp
                <a href="{{ route('post.detail', $post->slug) }}" class="col-md-4 text-decoration-none text-body">
                    <div>
                        <img  class="img-fluid my-1" src="{{ $img_thumbnail }}" alt="">
                    </div>
                    <h6 class="my-1">{{ $post->title }}</h6>
                </a>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <h4>Phổ biến</h4>
            <table class="table table-hover">
                <tbody>

                    @foreach ($popularPosts as $popularPost)
                    <tr>
                        <td>
                            <a  href="{{ route('post.detail', $popularPost->slug) }}" class="text-decoration-none text-body px-0">
                                <div class="row">
                                    <div class="col-12 col-sm-5 ">
                                        <img class="img-fluid border" 
                                             src="{{ str_contains($popularPost->img_thumbnail, 'http') ? $popularPost->img_thumbnail : Storage::url($post->img_thumbnail) }}" 
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
@endsection