@extends('adminlte::page')

@section('title', 'Edit Landing Page Section')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Landing Page Section</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.landing-page.index') }}">Landing Page Sections</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Section: {{ $section->name }}</h3>
                    </div>
                    <form action="{{ route('admin.landing-page.update', $section->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Section Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $section->name) }}" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="section_type">Section Type</label>
                                <select class="form-control @error('section_type') is-invalid @enderror" id="section_type" name="section_type" required>
                                    <option value="">Select Type</option>
                                    @foreach($sectionTypes as $value => $label)
                                        <option value="{{ $value }}" {{ old('section_type', $section->section_type) == $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('section_type')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $section->title) }}">
                                @error('title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="subtitle">Subtitle</label>
                                <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle" value="{{ old('subtitle', $section->subtitle) }}">
                                @error('subtitle')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5">{{ old('content', $section->content) }}</textarea>
                                @error('content')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="button_text">Button Text</label>
                                        <input type="text" class="form-control @error('button_text') is-invalid @enderror" id="button_text" name="button_text" value="{{ old('button_text', $section->button_text) }}">
                                        @error('button_text')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="button_url">Button URL</label>
                                        <input type="text" class="form-control @error('button_url') is-invalid @enderror" id="button_url" name="button_url" value="{{ old('button_url', $section->button_url) }}">
                                        @error('button_url')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="images">Images</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input @error('images') is-invalid @enderror" id="images" name="images[]" multiple>
                                                <label class="custom-file-label" for="images">Choose files</label>
                                            </div>
                                        </div>
                                        @error('images')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        @error('images.*')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                        <div class="mt-2 row" id="images-preview">
                                            @php
                                                $sliderImages = [];
                                                if (isset($section->extra_data['slider_images']) && is_array($section->extra_data['slider_images'])) {
                                                    $sliderImages = $section->extra_data['slider_images'];
                                                } elseif ($section->image) {
                                                    // For backward compatibility
                                                    $sliderImages[] = $section->image;
                                                    if (isset($section->extra_data['additional_images']) && is_array($section->extra_data['additional_images'])) {
                                                        $sliderImages = array_merge($sliderImages, $section->extra_data['additional_images']);
                                                    }
                                                }
                                            @endphp

                                            @foreach($sliderImages as $sliderImage)
                                                <div class="col-md-4 mb-2">
                                                    <div class="image-container position-relative">
                                                        <img src="{{ asset($sliderImage) }}" alt="Slider image" class="img-thumbnail" style="height: 100px; width: 100%; object-fit: cover;">
                                                        <input type="hidden" name="existing_images[]" value="{{ $sliderImage }}">
                                                        <button type="button" class="btn btn-sm btn-danger position-absolute" style="top: 0; right: 0;" onclick="removeImage(this)">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="background_image">Background Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input @error('background_image') is-invalid @enderror" id="background_image" name="background_image">
                                                <label class="custom-file-label" for="background_image">Choose file</label>
                                            </div>
                                        </div>
                                        @error('background_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                        @if($section->background_image)
                                            <div class="mt-2">
                                                <img src="{{ asset( $section->background_image) }}" alt="Background" class="img-thumbnail" style="max-height: 100px;">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if($section->section_type == 'showcase')
                            <div class="form-group">
                                <label>Slider Images</label>
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">App Showcase Slider Images</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @php
                                                $sliderImages = [];
                                                if (isset($section->extra_data['slider_images']) && is_array($section->extra_data['slider_images'])) {
                                                    $sliderImages = $section->extra_data['slider_images'];
                                                }
                                            @endphp

                                            @foreach($sliderImages as $index => $image)
                                            <div class="col-md-4 mb-3">
                                                <div class="card">
                                                    <img src="{{ asset($image) }}" class="card-img-top" alt="Slider Image">
                                                    <div class="card-body">
                                                        <input type="text" name="slider_images[]" class="form-control" value="{{ $image }}">
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-body text-center">
                                                        <button type="button" class="btn btn-primary add-slider-image">
                                                            <i class="fas fa-plus"></i> Add Image
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="order">Order</label>
                                        <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $section->order) }}">
                                        @error('order')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch mt-4">
                                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $section->is_active) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="is_active">Active</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.landing-page.index') }}" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <style>
        .image-container {
            position: relative;
            margin-bottom: 10px;
        }
    </style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    <script>
        // Function to handle image removal
        function removeImage(button) {
            $(button).closest('.col-md-4').remove();
        }

        // Function to preview images before upload
        function previewImages(input) {
            if (input.files) {
                for (let i = 0; i < input.files.length; i++) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const html = `
                            <div class="col-md-4 mb-2">
                                <div class="image-container position-relative">
                                    <img src="${e.target.result}" class="img-thumbnail" style="height: 100px; width: 100%; object-fit: cover;">
                                    <button type="button" class="btn btn-sm btn-danger position-absolute" style="top: 0; right: 0;" onclick="removeImage(this)">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        `;
                        $('#images-preview').append(html);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }

        $(function () {
            // Enable custom file input
            bsCustomFileInput.init();

            // Handle image preview
            $('#images').on('change', function() {
                previewImages(this);
            });

            // Initialize summernote for rich text editing
            $('#content').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            // Show/hide slider images section based on section type
            $('#section_type').on('change', function() {
                if ($(this).val() === 'showcase') {
                    $('.slider-images-section').show();
                } else {
                    $('.slider-images-section').hide();
                }
            });

            // Add new slider image
            $('.add-slider-image').on('click', function() {
                var newImageHtml = `
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <input type="text" name="slider_images[]" class="form-control" placeholder="Image path (e.g. img/app5.png)">
                                <button type="button" class="btn btn-danger btn-sm mt-2 remove-slider-image">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                $(this).closest('.card').closest('.col-md-4').before(newImageHtml);
            });

            // Remove slider image
            $(document).on('click', '.remove-slider-image', function() {
                $(this).closest('.col-md-4').remove();
            });
        });
    </script>
@stop
