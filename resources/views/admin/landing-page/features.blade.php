@extends('adminlte::page')

@section('title',
    $section->section_type === 'showcase' ? 'Manage Showcases' :
    ($section->section_type === 'intro' ? 'Manage Intro Items' : 'Manage Features')
)

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    @if($section->section_type === 'showcase')
                        Manage Showcases
                    @elseif($section->section_type === 'intro')
                        Manage Intro Items
                    @else
                        Manage Features
                    @endif
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.landing-page.index') }}">Landing Page Sections</a></li>
                    <li class="breadcrumb-item active">
                        @if($section->section_type === 'showcase')
                            Showcases
                        @elseif($section->section_type === 'intro')
                            Intro Items
                        @else
                            Features
                        @endif
                    </li>
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
                        <h3 class="card-title">
                            @if($section->section_type === 'showcase')
                                Showcases
                            @elseif($section->section_type === 'intro')
                                Intro Items
                            @else
                                Features
                            @endif
                            for: {{ $section->name }}
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addFeatureModal">
                                <i class="fas fa-plus"></i> Add New
                                @if($section->section_type === 'showcase')
                                    Showcase
                                @elseif($section->section_type === 'intro')
                                    Intro Item
                                @else
                                    Feature
                                @endif
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @forelse($features as $feature)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">{{ $feature->title }}</h5>
                                            <div class="card-tools">
                                                <span class="badge badge-{{ $feature->is_active ? 'success' : 'danger' }}">
                                                    {{ $feature->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @if($feature->image)
                                                <img src="{{ asset( $feature->image) }}" alt="{{ $feature->title }}" class="img-fluid mb-2" style="max-height: 100px;">
                                            @endif

                                            @if($feature->icon)
                                                <div class="text-center mb-2">
                                                    <i class="{{ $feature->icon }} fa-3x"></i>
                                                </div>
                                            @endif

                                            <p>{{ Str::limit($feature->description, 100) }}</p>

                                            <div class="mt-3">
                                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editFeatureModal{{ $feature->id }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteFeatureModal{{ $feature->id }}">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">Order: {{ $feature->order }}</small>
                                            @if(isset($feature->extra_data['position']))
                                                <span class="badge badge-info float-right">
                                                    Position: {{ ucfirst($feature->extra_data['position']) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Feature Modal -->
                                <div class="modal fade" id="editFeatureModal{{ $feature->id }}" tabindex="-1" role="dialog" aria-labelledby="editFeatureModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.features.update', $feature->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editFeatureModalLabel">Edit
                                                        @if($section->section_type === 'showcase')
                                                            Showcase
                                                        @elseif($section->section_type === 'intro')
                                                            Intro Item
                                                        @else
                                                            Feature
                                                        @endif
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="title{{ $feature->id }}">Title</label>
                                                        <input type="text" class="form-control" id="title{{ $feature->id }}" name="title" value="{{ $feature->title }}" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="description{{ $feature->id }}">Description</label>
                                                        <textarea class="form-control" id="description{{ $feature->id }}" name="description" rows="3">{{ $feature->description }}</textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="icon{{ $feature->id }}">Icon Class (FontAwesome or Themify)</label>
                                                        <input type="text" class="form-control" id="icon{{ $feature->id }}" name="icon" value="{{ $feature->icon }}" placeholder="e.g. fas fa-star or ti-star">
                                                        <small class="form-text text-muted">Enter a FontAwesome or Themify icon class</small>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="image{{ $feature->id }}">Image</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="image{{ $feature->id }}" name="image">
                                                                <label class="custom-file-label" for="image{{ $feature->id }}">Choose file</label>
                                                            </div>
                                                        </div>
                                                        @if($feature->image)
                                                            <div class="mt-2">
                                                                <img src="{{ asset( $feature->image) }}" alt="{{ $feature->title }}" class="img-thumbnail" style="max-height: 100px;">
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="order{{ $feature->id }}">Order</label>
                                                                <input type="number" class="form-control" id="order{{ $feature->id }}" name="order" value="{{ $feature->order }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="position{{ $feature->id }}">Position</label>
                                                                @php
                                                                    $position = '';
                                                                    if (isset($feature->extra_data['position'])) {
                                                                        $position = $feature->extra_data['position'];
                                                                    }
                                                                @endphp
                                                                <select class="form-control" id="position{{ $feature->id }}" name="position">
                                                                    <option value="">None</option>
                                                                    <option value="left" {{ $position == 'left' ? 'selected' : '' }}>Left</option>
                                                                    <option value="right" {{ $position == 'right' ? 'selected' : '' }}>Right</option>
                                                                </select>
                                                                <small class="form-text text-muted">For App Showcase section only</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <div class="custom-control custom-switch mt-4">
                                                                    <input type="checkbox" class="custom-control-input" id="is_active{{ $feature->id }}" name="is_active" value="1" {{ $feature->is_active ? 'checked' : '' }}>
                                                                    <label class="custom-control-label" for="is_active{{ $feature->id }}">Active</label>
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

                                <!-- Delete Feature Modal -->
                                <div class="modal fade" id="deleteFeatureModal{{ $feature->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteFeatureModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteFeatureModalLabel">Confirm Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete the
                                                @if($section->section_type === 'showcase')
                                                    showcase
                                                @elseif($section->section_type === 'intro')
                                                    intro item
                                                @else
                                                    feature
                                                @endif
                                                "{{ $feature->title }}"?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.features.destroy', $feature->id) }}" method="POST">
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
                                        No
                                        @if($section->section_type === 'showcase')
                                            showcases
                                        @elseif($section->section_type === 'intro')
                                            intro items
                                        @else
                                            features
                                        @endif
                                        found for this section. Click "Add New
                                        @if($section->section_type === 'showcase')
                                            Showcase
                                        @elseif($section->section_type === 'intro')
                                            Intro Item
                                        @else
                                            Feature
                                        @endif
                                        " to create one.
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

    <!-- Add Feature Modal -->
    <div class="modal fade" id="addFeatureModal" tabindex="-1" role="dialog" aria-labelledby="addFeatureModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.landing-page.features.store', $section->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFeatureModalLabel">Add New
                            @if($section->section_type === 'showcase')
                                Showcase
                            @elseif($section->section_type === 'intro')
                                Intro Item
                            @else
                                Feature
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="icon">Icon Class (FontAwesome or Themify)</label>
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="e.g. fas fa-star or ti-star">
                            <small class="form-text text-muted">Enter a FontAwesome or Themify icon class</small>
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
                                    <label for="order">Order</label>
                                    <input type="number" class="form-control" id="order" name="order" value="0">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="position">Position</label>
                                    <select class="form-control" id="position" name="position">
                                        <option value="">None</option>
                                        <option value="left">Left</option>
                                        <option value="right">Right</option>
                                    </select>
                                    <small class="form-text text-muted">For App Showcase section only</small>
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
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <script>
        $(function () {
            // Enable custom file input
            bsCustomFileInput.init();

            // Enable tooltips
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop
