@extends('adminlte::page')

@section('title', 'Blog Posts')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Blog Posts</h1>
        <a href="{{ route('admin.blog.posts.create') }}" class="btn btn-primary">Create New Post</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Categories</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>
                                @foreach($post->categories as $category)
                                    <span class="badge badge-info">{{ $category->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if($post->is_published)
                                    <span class="badge badge-success">Published</span>
                                    <small>{{ $post->published_at->format('Y-m-d') }}</small>
                                @else
                                    <span class="badge badge-warning">Draft</span>
                                @endif
                            </td>
                            <td>{{ $post->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-sm btn-info" target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.blog.posts.edit', $post) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.blog.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No blog posts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .btn-group form {
            display: inline-block;
        }
    </style>
@stop
