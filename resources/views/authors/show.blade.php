@extends('layouts.home')

@section('title', $author->name)

@section('sub_title', 'Joined On: '.\Carbon\Carbon::parse($author->created_at)->toFormattedDateString())

@section('bg_img', '/home-assets/assets/img/home-bg.jpg')

@section('content')

    <!-- Main Content-->
    <div class="container">
        <div class="col-lg-12 mx-auto">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Excerpt</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>
                            <a href="{{ route('posts.show', $post->slug) }}">
                                {{ $post->title }}
                            </a>
                        </td>
                        <td>{{ $post->excerpt }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $posts->links() !!}
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function deletePost(postId) {
            if (confirm('Are you sure, you want to delete post?')) {
                document.getElementById('delete-' + postId).submit();
            }
        }
    </script>
@endsection
