@extends('layouts.home')

@section('title', 'My Posts')

@section('sub_title', 'Manage your blog posts')

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
                    <th>Status</th>
                    <th>Actions</th>
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
                        <td>
                            <span class="badge bg-{{ $post->state == \App\Enums\PostState::DRAFT ? 'primary' : 'success' }}">
                                {{ \App\Enums\PostState::getDescription((int) $post->state) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-sm btn-info">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            @if ($post->state == \App\Enums\PostState::DRAFT)
                                <a onclick="deletePost({{ $post->id }})" href="#" class="btn btn-sm btn-danger">
                                    <i class="fa fa-times"></i> Delete
                                </a>
                                <form id="delete-{{ $post->id }}" method="post" action="{{ route('posts.destroy', $post->id) }}">
                                    @csrf
                                    @method('delete')
                                </form>
                            @endif
                        </td>
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
