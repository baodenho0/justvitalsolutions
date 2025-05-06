@extends('adminlte::page')

@section('title', 'View Comment')

@section('content_header')
    <h1>View Comment</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <h5>Comment Details</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 150px;">ID</th>
                            <td>{{ $comment->id }}</td>
                        </tr>
                        <tr>
                            <th>Author</th>
                            <td>{{ $comment->user->name }} ({{ $comment->user->email }})</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($comment->is_approved)
                                    <span class="badge badge-success">Approved</span>
                                @else
                                    <span class="badge badge-warning">Pending</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created</th>
                            <td>{{ $comment->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Updated</th>
                            <td>{{ $comment->updated_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Parent Comment</th>
                            <td>
                                @if($comment->parent)
                                    <a href="{{ route('admin.blog.comments.show', $comment->parent) }}">
                                        #{{ $comment->parent->id }} by {{ $comment->parent->user->name }}
                                    </a>
                                @else
                                    <span class="text-muted">None (Top-level comment)</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h5>Related Post</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 150px;">Post ID</th>
                            <td>{{ $comment->post->id }}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>
                                <a href="{{ route('blog.show', $comment->post->slug) }}" target="_blank">
                                    {{ $comment->post->title }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Author</th>
                            <td>{{ $comment->post->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Published</th>
                            <td>
                                @if($comment->post->is_published)
                                    <span class="badge badge-success">Yes</span>
                                    {{ $comment->post->published_at->format('Y-m-d') }}
                                @else
                                    <span class="badge badge-warning">No (Draft)</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Comment Content</h5>
                        </div>
                        <div class="card-body">
                            <p>{{ $comment->content }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($comment->replies->count() > 0)
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Replies ({{ $comment->replies->count() }})</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Author</th>
                                        <th>Content</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($comment->replies as $reply)
                                    <tr>
                                        <td>{{ $reply->id }}</td>
                                        <td>{{ $reply->user->name }}</td>
                                        <td>{{ Str::limit($reply->content, 50) }}</td>
                                        <td>
                                            @if($reply->is_approved)
                                                <span class="badge badge-success">Approved</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>{{ $reply->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.blog.comments.show', $reply) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if($reply->is_approved)
                                                    <form action="{{ route('admin.blog.comments.disapprove', $reply) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.blog.comments.approve', $reply) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('admin.blog.comments.destroy', $reply) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reply?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex">
                        @if($comment->is_approved)
                            <form action="{{ route('admin.blog.comments.disapprove', $comment) }}" method="POST" class="mr-2">
                                @csrf
                                <button type="submit" class="btn btn-warning">Disapprove Comment</button>
                            </form>
                        @else
                            <form action="{{ route('admin.blog.comments.approve', $comment) }}" method="POST" class="mr-2">
                                @csrf
                                <button type="submit" class="btn btn-success">Approve Comment</button>
                            </form>
                        @endif

                        <form action="{{ route('admin.blog.comments.destroy', $comment) }}" method="POST" class="mr-2" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Comment</button>
                        </form>

                        <a href="{{ route('admin.blog.comments.index') }}" class="btn btn-secondary">Back to Comments</a>
                    </div>
                </div>
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
