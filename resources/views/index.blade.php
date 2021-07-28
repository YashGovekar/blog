@extends('layouts.home')

@section('title', 'Home')

@section('sub_title', 'Welcome to '.config('app.name'))


@section('content')

    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
            @foreach($posts as $post)
                <!-- Post preview-->
                <div class="post-preview">
                    <a href="{{ route('posts.show', $post->slug) }}">
                        <h2 class="post-title">{{ $post->title }}</h2>
                        <h3 class="post-subtitle">{{ $post->excerpt }}</h3>
                    </a>
                    <p class="post-meta">
                        Posted by
                        <a href="{{ route('authors.show', $post->author->id) }}">{{ $post->author->name }}</a>
                        on {{ \Carbon\Carbon::parse($post->posted_at)->toDayDateTimeString() }}
                    </p>
                </div>
                <!-- Divider-->
                <hr class="my-4" />
            @endforeach

            {!! $posts->links() !!}
            </div>
        </div>
    </div>
@endsection
