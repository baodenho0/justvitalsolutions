@extends('adminlte::page')

@section('title', 'Edit Blog Category')

@section('content_header')
    <h1>Edit Blog Category</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.blog.categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" value="{{ $category->slug }}" disabled>
                    <small class="form-text text-muted">The slug will be automatically updated if you change the name.</small>
                </div>

                <div class="form-group">
                    <label for="description">Description (optional)</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Category</button>
                    <a href="{{ route('admin.blog.categories.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@stop
