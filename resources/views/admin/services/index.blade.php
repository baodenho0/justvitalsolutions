@extends('adminlte::page')

@section('title', 'Services Page')

@section('content_header')
    <h1>Services Page</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Services Page Settings</h3>
            <div class="card-tools">
                <a href="{{ route('admin.services.edit') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> Edit Page
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Title</label>
                        <p>{{ $service->title ?? 'Not set' }}</p>
                    </div>
                    <div class="form-group">
                        <label>Subtitle</label>
                        <p>{{ $service->subtitle ?? 'Not set' }}</p>
                    </div>
                    <div class="form-group">
                        <label>Banner Image</label>
                        @if($service->banner_image)
                            <div>
                                <img src="{{ asset($service->banner_image) }}" alt="Banner Image" class="img-fluid" style="max-height: 200px;">
                            </div>
                        @else
                            <p>No banner image set</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Status</label>
                        <p>
                            @if($service->is_active ?? false)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </p>
                    </div>
                    <div class="form-group">
                        <label>Intro Text</label>
                        <div>{!! $service->intro_text ?? 'Not set' !!}</div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Service Items</h4>
                        </div>
                        <div class="card-body">
                            @if(isset($service->service_items) && is_array($service->service_items) && count($service->service_items) > 0)
                                <div class="row">
                                    @foreach($service->service_items as $item)
                                        <div class="col-md-4 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="text-center mb-3">
                                                        <i class="{{ $item['icon'] ?? 'ti-star' }}" style="font-size: 2rem;"></i>
                                                    </div>
                                                    <h5 class="text-center">{{ $item['title'] ?? 'Unnamed Service' }}</h5>
                                                    <p>{!! $item['description'] ?? '' !!}</p>
                                                    @if(isset($item['image']))
                                                        <div class="text-center mt-3">
                                                            <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] ?? 'Service' }}" class="img-fluid" style="max-height: 100px;">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>No service items defined</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Call to Action</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Show CTA Section</label>
                                <p>
                                    @if($service->show_cta ?? false)
                                        <span class="badge badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-danger">No</span>
                                    @endif
                                </p>
                            </div>

                            @if($service->show_cta ?? false)
                                <div class="form-group">
                                    <label>CTA Title</label>
                                    <p>{{ $service->cta_title ?? 'Not set' }}</p>
                                </div>
                                <div class="form-group">
                                    <label>CTA Description</label>
                                    <p>{{ $service->cta_description ?? 'Not set' }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Button Text</label>
                                    <p>{{ $service->cta_button_text ?? 'Not set' }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Button URL</label>
                                    <p>{{ $service->cta_button_url ?? 'Not set' }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
