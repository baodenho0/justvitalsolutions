@extends('admin.layouts.admin')

@section('title', 'Contact Page')

@section('content_header')
    <h1>Contact Page</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Contact Page Settings</h3>
            <div class="card-tools">
                <a href="{{ route('admin.contact.edit') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> Edit Page
                </a>
                <a href="{{ route('admin.contact.submissions') }}" class="btn btn-info btn-sm ml-2">
                    <i class="fas fa-envelope"></i> View Submissions
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
                        <p>{{ $contact->title ?? 'Not set' }}</p>
                    </div>
                    <div class="form-group">
                        <label>Subtitle</label>
                        <p>{{ $contact->subtitle ?? 'Not set' }}</p>
                    </div>
                    <div class="form-group">
                        <label>Banner Image</label>
                        @if($contact->banner_image)
                            <div>
                                <img src="{{ asset($contact->banner_image) }}" alt="Banner Image" class="img-fluid" style="max-height: 200px;">
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
                            @if($contact->is_active ?? false)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </p>
                    </div>
                    <div class="form-group">
                        <label>Intro Text</label>
                        <div>{!! $contact->intro_text ?? 'Not set' !!}</div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Contact Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Address</label>
                                <p>{{ $contact->address ?? 'Not set' }}</p>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <p>{{ $contact->phone ?? 'Not set' }}</p>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <p>{{ $contact->email ?? 'Not set' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Office Hours</h4>
                        </div>
                        <div class="card-body">
                            @if(isset($contact->office_hours) && is_array($contact->office_hours) && count($contact->office_hours) > 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Day</th>
                                            <th>Hours</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($contact->office_hours as $hours)
                                            <tr>
                                                <td>{{ $hours['day'] ?? 'Unnamed' }}</td>
                                                <td>{{ $hours['hours'] ?? 'Not set' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>No office hours defined</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Contact Form</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Show Contact Form</label>
                                <p>
                                    @if($contact->show_contact_form ?? true)
                                        <span class="badge badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-danger">No</span>
                                    @endif
                                </p>
                            </div>

                            @if($contact->show_contact_form ?? true)
                                <div class="form-group">
                                    <label>Form Title</label>
                                    <p>{{ $contact->form_title ?? 'Not set' }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Form Description</label>
                                    <p>{{ $contact->form_description ?? 'Not set' }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Map</h4>
                        </div>
                        <div class="card-body">
                            @if($contact->map_embed_code)
                                <div class="embed-responsive embed-responsive-16by9">
                                    {!! $contact->map_embed_code !!}
                                </div>
                            @else
                                <p>No map embed code set</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
