@extends('admin.layouts.admin')

@section('title', 'Landing Page Sections')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Landing Page Sections</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Landing Page Sections</li>
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
                        <h3 class="card-title">Manage Landing Page Sections</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.landing-page.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Add New Section
                            </a>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sections as $section)
                                <tr>
                                    <td>{{ $section->order }}</td>
                                    <td>{{ $section->name }}</td>
                                    <td>
                                        <span class="badge badge-info">{{ $section->section_type }}</span>
                                    </td>
                                    <td>{{ $section->title }}</td>
                                    <td>
                                        @if($section->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.landing-page.edit', $section->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>

                                            @if($section->section_type === 'features')
                                            <a href="{{ route('admin.landing-page.features', $section->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-list"></i> Features
                                            </a>
                                            @endif

                                            @if($section->section_type === 'showcase')
                                            <a href="{{ route('admin.landing-page.features', $section->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-laptop"></i> Showcases
                                            </a>
                                            @endif

                                            @if($section->section_type === 'intro')
                                            <a href="{{ route('admin.landing-page.features', $section->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-info-circle"></i> Intro Items
                                            </a>
                                            @endif

                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $section->id }}">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $section->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete the section "{{ $section->name }}"?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <form action="{{ route('admin.landing-page.destroy', $section->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No sections found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
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
            // Enable tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Flash message auto-hide
            $('.alert-dismissible').fadeTo(5000, 500).slideUp(500);
        });
    </script>
@stop
