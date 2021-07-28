@extends('layouts.home')

@section('title', 'Create Post')

@section('sub_title', 'Create an amazing blog post!')

@section('bg_img', '/home-assets/assets/img/home-bg.jpg')

@section('content')

    <!-- Main Content-->
    <div class="container">
        <div class="col-lg-12 mx-auto">
            <form method="post" action="{{ route('posts.update', $post->slug) }}">
                @method('patch')
                @include('posts.fields')
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 350
            });
        });
    </script>
@endsection
