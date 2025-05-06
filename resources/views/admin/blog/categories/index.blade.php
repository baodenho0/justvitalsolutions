@extends('adminlte::page')

@section('title', 'Blog Categories')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Blog Categories</h1>
        <a href="{{ route('admin.blog.categories.create') }}" class="btn btn-primary">Create New Category</a>
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
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Posts</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->posts_count }}</td>
                            <td>{{ $category->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('blog.category', $category->slug) }}" class="btn btn-sm btn-info" target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.blog.categories.edit', $category) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.blog.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
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
                            <td colspan="6" class="text-center">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $categories->links() }}
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
