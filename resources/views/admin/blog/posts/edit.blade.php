@extends('adminlte::page')

@section('title', 'Edit Blog Post')

@section('content_header')
    <h1>Edit Blog Post</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.blog.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $post->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" value="{{ $post->slug }}" disabled>
                    <small class="form-text text-muted">The slug will be automatically updated if you change the title.</small>
                </div>

                <div class="form-group">
                    <label for="excerpt">Excerpt (optional)</label>
                    <textarea class="form-control @error('excerpt') is-invalid @enderror" id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $post->excerpt) }}</textarea>
                    @error('excerpt')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">A short summary of the post that will be displayed in listings.</small>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10" required>{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="featured_image">Featured Image</label>
                    @if($post->featured_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Featured Image" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    @endif
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('featured_image') is-invalid @enderror" id="featured_image" name="featured_image">
                            <label class="custom-file-label" for="featured_image">Choose new file</label>
                        </div>
                    </div>
                    @error('featured_image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Recommended size: 1200x600px. Max size: 2MB. Leave empty to keep the current image.</small>
                </div>

                <div class="form-group">
                    <label>Categories</label>
                    <div class="select2-purple">
                        <select class="select2 @error('categories') is-invalid @enderror" name="categories[]" multiple="multiple" data-placeholder="Select categories" style="width: 100%;">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', $post->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('categories')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="is_published" name="is_published" value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_published">Published</label>
                    </div>
                </div>

                <div class="form-group" id="published_at_group" style="{{ old('is_published', $post->is_published) ? '' : 'display: none;' }}">
                    <label for="published_at">Publication Date</label>
                    <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror" id="published_at" name="published_at" value="{{ old('published_at', $post->published_at ? date('Y-m-d\TH:i', strtotime($post->published_at)) : date('Y-m-d\TH:i')) }}">
                    @error('published_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Post</button>
                    <a href="{{ route('admin.blog.posts.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            bsCustomFileInput.init();

            // Initialize Summernote
            $('#content').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            // Initialize Select2
            $('.select2').select2({
                theme: 'bootstrap4',
            });

            // Toggle publication date field
            $('#is_published').change(function() {
                if(this.checked) {
                    $('#published_at_group').show();
                } else {
                    $('#published_at_group').hide();
                }
            });
        });
    </script>
@stop
