@extends('adminlte::page')

@section('title', 'Blog Comments')

@section('content_header')
    <h1>Blog Comments</h1>
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
                        <th>Author</th>
                        <th>Comment</th>
                        <th>Post</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td>{{ Str::limit($comment->content, 50) }}</td>
                            <td>
                                <a href="{{ route('blog.show', $comment->post->slug) }}" target="_blank">
                                    {{ Str::limit($comment->post->title, 30) }}
                                </a>
                            </td>
                            <td>
                                @if($comment->is_approved)
                                    <span class="badge badge-success">Approved</span>
                                @else
                                    <span class="badge badge-warning">Pending</span>
                                @endif
                            </td>
                            <td>{{ $comment->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.blog.comments.show', $comment) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($comment->is_approved)
                                        <form action="{{ route('admin.blog.comments.disapprove', $comment) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.blog.comments.approve', $comment) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.blog.comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
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
                            <td colspan="7" class="text-center">No comments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $comments->links() }}
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
