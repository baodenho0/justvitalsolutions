@extends('adminlte::page')

@section('title', 'Manage Testimonials')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Testimonials</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.landing-page.index') }}">Landing Page Sections</a></li>
                    <li class="breadcrumb-item active">Testimonials</li>
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
                        <h3 class="card-title">Testimonials for: {{ $section->name }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addTestimonialModal">
                                <i class="fas fa-plus"></i> Add New Testimonial
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @forelse($testimonials as $testimonial)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">{{ $testimonial->name }}</h5>
                                            <div class="card-tools">
                                                <span class="badge badge-{{ $testimonial->is_active ? 'success' : 'danger' }}">
                                                    {{ $testimonial->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                @if($testimonial->image)
                                                    <img src="{{ asset( $testimonial->image) }}" alt="{{ $testimonial->name }}" class="img-circle mr-3" style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <div class="img-circle mr-3 bg-secondary d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                                        <i class="fas fa-user fa-2x text-white"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <strong>{{ $testimonial->name }}</strong>
                                                    @if($testimonial->position || $testimonial->company)
                                                        <p class="text-muted mb-0">
                                                            {{ $testimonial->position }}
                                                            @if($testimonial->position && $testimonial->company), @endif
                                                            {{ $testimonial->company }}
                                                        </p>
                                                    @endif
                                                    @if($testimonial->rating)
                                                        <div>
                                                            @for($i = 1; $i <= 5; $i++)
                                                                @if($i <= $testimonial->rating)
                                                                    <i class="fas fa-star text-warning"></i>
                                                                @else
                                                                    <i class="far fa-star text-warning"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <p>{{ Str::limit($testimonial->content, 150) }}</p>

                                            <div class="mt-3">
                                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editTestimonialModal{{ $testimonial->id }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteTestimonialModal{{ $testimonial->id }}">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">Order: {{ $testimonial->order }}</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Testimonial Modal -->
                                <div class="modal fade" id="editTestimonialModal{{ $testimonial->id }}" tabindex="-1" role="dialog" aria-labelledby="editTestimonialModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editTestimonialModalLabel">Edit Testimonial</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="name{{ $testimonial->id }}">Name</label>
                                                        <input type="text" class="form-control" id="name{{ $testimonial->id }}" name="name" value="{{ $testimonial->name }}" required>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="position{{ $testimonial->id }}">Position</label>
                                                                <input type="text" class="form-control" id="position{{ $testimonial->id }}" name="position" value="{{ $testimonial->position }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="company{{ $testimonial->id }}">Company</label>
                                                                <input type="text" class="form-control" id="company{{ $testimonial->id }}" name="company" value="{{ $testimonial->company }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="content{{ $testimonial->id }}">Content</label>
                                                        <textarea class="form-control" id="content{{ $testimonial->id }}" name="content" rows="4" required>{{ $testimonial->content }}</textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="image{{ $testimonial->id }}">Image</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="image{{ $testimonial->id }}" name="image">
                                                                <label class="custom-file-label" for="image{{ $testimonial->id }}">Choose file</label>
                                                            </div>
                                                        </div>
                                                        @if($testimonial->image)
                                                            <div class="mt-2">
                                                                <img src="{{ asset( $testimonial->image) }}" alt="{{ $testimonial->name }}" class="img-thumbnail" style="max-height: 100px;">
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="rating{{ $testimonial->id }}">Rating (1-5)</label>
                                                                <select class="form-control" id="rating{{ $testimonial->id }}" name="rating">
                                                                    <option value="">No Rating</option>
                                                                    @for($i = 1; $i <= 5; $i++)
                                                                        <option value="{{ $i }}" {{ $testimonial->rating == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="order{{ $testimonial->id }}">Order</label>
                                                                <input type="number" class="form-control" id="order{{ $testimonial->id }}" name="order" value="{{ $testimonial->order }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <div class="custom-control custom-switch mt-4">
                                                                    <input type="checkbox" class="custom-control-input" id="is_active{{ $testimonial->id }}" name="is_active" value="1" {{ $testimonial->is_active ? 'checked' : '' }}>
                                                                    <label class="custom-control-label" for="is_active{{ $testimonial->id }}">Active</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Testimonial Modal -->
                                <div class="modal fade" id="deleteTestimonialModal{{ $testimonial->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteTestimonialModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteTestimonialModalLabel">Confirm Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete the testimonial from "{{ $testimonial->name }}"?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        No testimonials found for this section. Click "Add New Testimonial" to create one.
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.landing-page.index') }}" class="btn btn-default">Back to Sections</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Testimonial Modal -->
    <div class="modal fade" id="addTestimonialModal" tabindex="-1" role="dialog" aria-labelledby="addTestimonialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.landing-page.testimonials.store', $section->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTestimonialModalLabel">Add New Testimonial</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="position">Position</label>
                                    <input type="text" class="form-control" id="position" name="position">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <input type="text" class="form-control" id="company" name="company">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="rating">Rating (1-5)</label>
                                    <select class="form-control" id="rating" name="rating">
                                        <option value="">No Rating</option>
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="order">Order</label>
                                    <input type="number" class="form-control" id="order" name="order" value="0">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="custom-control custom-switch mt-4">
                                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" checked>
                                        <label class="custom-control-label" for="is_active">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(function () {
            // Enable custom file input
            bsCustomFileInput.init();

            // Enable tooltips
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop
