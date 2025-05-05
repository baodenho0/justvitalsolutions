@extends('adminlte::page')

@section('title', 'Edit Contact Page')

@section('content_header')
    <h1>Edit Contact Page</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Contact Page</h3>
            <div class="card-tools">
                <a href="{{ route('admin.contact.index') }}" class="btn btn-default btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.contact.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $contact->title ?? 'Contact Us') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="subtitle">Subtitle</label>
                            <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle" value="{{ old('subtitle', $contact->subtitle ?? '') }}">
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="banner_image">Banner Image</label>
                            @if($contact->banner_image ?? false)
                                <div class="mb-2">
                                    <img src="{{ asset($contact->banner_image) }}" alt="Current Banner" class="img-fluid" style="max-height: 200px;">
                                </div>
                            @endif
                            <input type="file" class="form-control-file @error('banner_image') is-invalid @enderror" id="banner_image" name="banner_image">
                            <small class="form-text text-muted">Recommended size: 1920x500 pixels</small>
                            @error('banner_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ (old('is_active', $contact->is_active ?? true) ? 'checked' : '') }}>
                                <label class="custom-control-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="intro_text">Intro Text</label>
                            <textarea class="form-control @error('intro_text') is-invalid @enderror" id="intro_text" name="intro_text" rows="5">{{ old('intro_text', $contact->intro_text ?? '') }}</textarea>
                            @error('intro_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $contact->address ?? '') }}">
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $contact->phone ?? '') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $contact->email ?? '') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Office Hours</h4>
                                <button type="button" class="btn btn-sm btn-primary float-right" id="add-office-hours">Add Hours</button>
                            </div>
                            <div class="card-body">
                                <div id="office-hours-container">
                                    @if(isset($contact->office_hours) && is_array($contact->office_hours) && count($contact->office_hours) > 0)
                                        @foreach($contact->office_hours as $index => $hours)
                                            <div class="row office-hours-row mb-3">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="office_hours[{{ $index }}][day]" placeholder="Day" value="{{ $hours['day'] ?? '' }}">
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="office_hours[{{ $index }}][hours]" placeholder="Hours" value="{{ $hours['hours'] ?? '' }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger remove-office-hours">Remove</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="row office-hours-row mb-3">
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="office_hours[0][day]" placeholder="Day" value="Monday - Friday">
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="office_hours[0][hours]" placeholder="Hours" value="9:00 AM - 5:00 PM">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger remove-office-hours">Remove</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
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
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="show_contact_form" name="show_contact_form" value="1" {{ (old('show_contact_form', $contact->show_contact_form ?? true) ? 'checked' : '') }}>
                                        <label class="custom-control-label" for="show_contact_form">Show Contact Form</label>
                                    </div>
                                </div>

                                <div id="form-fields" class="{{ (old('show_contact_form', $contact->show_contact_form ?? true) ? '' : 'd-none') }}">
                                    <div class="form-group">
                                        <label for="form_title">Form Title</label>
                                        <input type="text" class="form-control" id="form_title" name="form_title" value="{{ old('form_title', $contact->form_title ?? 'Send us a message') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="form_description">Form Description</label>
                                        <textarea class="form-control" id="form_description" name="form_description" rows="2">{{ old('form_description', $contact->form_description ?? "We'll get back to you as soon as possible.") }}</textarea>
                                    </div>
                                </div>
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
                                <div class="form-group">
                                    <label for="map_embed_code">Map Embed Code</label>
                                    <textarea class="form-control @error('map_embed_code') is-invalid @enderror" id="map_embed_code" name="map_embed_code" rows="5">{{ old('map_embed_code', $contact->map_embed_code ?? '') }}</textarea>
                                    <small class="form-text text-muted">Paste the embed code from Google Maps or other map service</small>
                                    @error('map_embed_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                @if($contact->map_embed_code ?? false)
                                    <div class="mt-3">
                                        <h5>Current Map Preview</h5>
                                        <div class="embed-responsive embed-responsive-16by9">
                                            {!! $contact->map_embed_code !!}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="{{ route('admin.contact.index') }}" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Initialize CKEditor for rich text areas
        if (typeof CKEDITOR !== 'undefined') {
            CKEDITOR.replace('intro_text');
            CKEDITOR.replace('form_description');
        }

        // Toggle form fields visibility
        $('#show_contact_form').change(function() {
            if ($(this).is(':checked')) {
                $('#form-fields').removeClass('d-none');
            } else {
                $('#form-fields').addClass('d-none');
            }
        });

        // Add new office hours
        $('#add-office-hours').click(function() {
            const hoursCount = $('.office-hours-row').length;
            const newHours = `
                <div class="row office-hours-row mb-3">
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="office_hours[${hoursCount}][day]" placeholder="Day">
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="office_hours[${hoursCount}][hours]" placeholder="Hours">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-office-hours">Remove</button>
                    </div>
                </div>
            `;
            $('#office-hours-container').append(newHours);
        });

        // Remove office hours
        $(document).on('click', '.remove-office-hours', function() {
            $(this).closest('.office-hours-row').remove();
        });
    });
</script>
@stop
