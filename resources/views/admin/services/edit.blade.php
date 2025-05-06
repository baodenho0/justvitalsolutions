@extends('admin.layouts.admin')

@section('title', 'Edit Services Page')

@section('content_header')
    <h1>Edit Services Page</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Services Page</h3>
            <div class="card-tools">
                <a href="{{ route('admin.services.index') }}" class="btn btn-default btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.services.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $service->title ?? 'Our Services') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="subtitle">Subtitle</label>
                            <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle" value="{{ old('subtitle', $service->subtitle ?? '') }}">
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="banner_image">Banner Image</label>
                            @if($service->banner_image ?? false)
                                <div class="mb-2">
                                    <img src="{{ asset($service->banner_image) }}" alt="Current Banner" class="img-fluid" style="max-height: 200px;">
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
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ (old('is_active', $service->is_active ?? true) ? 'checked' : '') }}>
                                <label class="custom-control-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="intro_text">Intro Text</label>
                            <textarea class="form-control @error('intro_text') is-invalid @enderror" id="intro_text" name="intro_text" rows="5">{{ old('intro_text', $service->intro_text ?? '') }}</textarea>
                            @error('intro_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Service Items</h4>
                                <button type="button" class="btn btn-sm btn-primary float-right" id="add-service-item">Add Service Item</button>
                            </div>
                            <div class="card-body">
                                <div id="service-items-container">
                                    @if(isset($service->service_items) && is_array($service->service_items) && count($service->service_items) > 0)
                                        @foreach($service->service_items as $index => $item)
                                            <div class="card mb-4 service-item-card">
                                                <div class="card-header">
                                                    <h5>Service Item</h5>
                                                    <button type="button" class="btn btn-sm btn-danger float-right remove-service-item">Remove</button>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Title</label>
                                                                <input type="text" class="form-control" name="service_items[{{ $index }}][title]" placeholder="Title" value="{{ $item['title'] ?? '' }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Description</label>
                                                                <textarea class="form-control service-description" name="service_items[{{ $index }}][description]" rows="3" placeholder="Description">{{ $item['description'] ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Icon</label>
                                                                <input type="text" class="form-control" name="service_items[{{ $index }}][icon]" placeholder="Icon class (e.g., ti-star)" value="{{ $item['icon'] ?? 'ti-star' }}">
                                                                <small class="form-text text-muted">Use Themify icons (ti-*) or Font Awesome (fa-*)</small>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Image (Optional)</label>
                                                                @if(isset($item['image']))
                                                                    <div class="mb-2">
                                                                        <img src="{{ asset($item['image']) }}" alt="Service Item" class="img-fluid" style="max-height: 100px;">
                                                                        <input type="hidden" name="service_items[{{ $index }}][existing_image]" value="{{ $item['image'] }}">
                                                                    </div>
                                                                @endif
                                                                <input type="file" class="form-control-file" name="service_items[{{ $index }}][image]">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="card mb-4 service-item-card">
                                            <div class="card-header">
                                                <h5>Service Item</h5>
                                                <button type="button" class="btn btn-sm btn-danger float-right remove-service-item">Remove</button>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Title</label>
                                                            <input type="text" class="form-control" name="service_items[0][title]" placeholder="Title" value="Branding">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea class="form-control service-description" name="service_items[0][description]" rows="3" placeholder="Description">We help businesses establish a strong brand identity that resonates with their target audience.</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Icon</label>
                                                            <input type="text" class="form-control" name="service_items[0][icon]" placeholder="Icon class (e.g., ti-star)" value="ti-crown">
                                                            <small class="form-text text-muted">Use Themify icons (ti-*) or Font Awesome (fa-*)</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Image (Optional)</label>
                                                            <input type="file" class="form-control-file" name="service_items[0][image]">
                                                        </div>
                                                    </div>
                                                </div>
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
                                <h4>Call to Action</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="show_cta" name="show_cta" value="1" {{ (old('show_cta', $service->show_cta ?? false) ? 'checked' : '') }}>
                                        <label class="custom-control-label" for="show_cta">Show CTA Section</label>
                                    </div>
                                </div>

                                <div id="cta-fields" class="{{ (old('show_cta', $service->show_cta ?? false) ? '' : 'd-none') }}">
                                    <div class="form-group">
                                        <label for="cta_title">CTA Title</label>
                                        <input type="text" class="form-control" id="cta_title" name="cta_title" value="{{ old('cta_title', $service->cta_title ?? 'Ready to get started?') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="cta_description">CTA Description</label>
                                        <textarea class="form-control" id="cta_description" name="cta_description" rows="2">{{ old('cta_description', $service->cta_description ?? 'Contact us today to discuss your project.') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="cta_button_text">Button Text</label>
                                        <input type="text" class="form-control" id="cta_button_text" name="cta_button_text" value="{{ old('cta_button_text', $service->cta_button_text ?? 'Get in Touch') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="cta_button_url">Button URL</label>
                                        <input type="text" class="form-control" id="cta_button_url" name="cta_button_url" value="{{ old('cta_button_url', $service->cta_button_url ?? '/contact') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-default">Cancel</a>
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
            $('.service-description').each(function() {
                CKEDITOR.replace(this);
            });
        }

        // Toggle CTA fields visibility
        $('#show_cta').change(function() {
            if ($(this).is(':checked')) {
                $('#cta-fields').removeClass('d-none');
            } else {
                $('#cta-fields').addClass('d-none');
            }
        });

        // Add new service item
        $('#add-service-item').click(function() {
            const serviceItemsCount = $('.service-item-card').length;
            const newServiceItem = `
                <div class="card mb-4 service-item-card">
                    <div class="card-header">
                        <h5>Service Item</h5>
                        <button type="button" class="btn btn-sm btn-danger float-right remove-service-item">Remove</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="service_items[${serviceItemsCount}][title]" placeholder="Title">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control new-service-description" name="service_items[${serviceItemsCount}][description]" rows="3" placeholder="Description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Icon</label>
                                    <input type="text" class="form-control" name="service_items[${serviceItemsCount}][icon]" placeholder="Icon class (e.g., ti-star)" value="ti-star">
                                    <small class="form-text text-muted">Use Themify icons (ti-*) or Font Awesome (fa-*)</small>
                                </div>
                                <div class="form-group">
                                    <label>Image (Optional)</label>
                                    <input type="file" class="form-control-file" name="service_items[${serviceItemsCount}][image]">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            $('#service-items-container').append(newServiceItem);

            // Initialize CKEditor for the new textarea
            if (typeof CKEDITOR !== 'undefined') {
                CKEDITOR.replace($('.new-service-description').last()[0]);
                $('.new-service-description').removeClass('new-service-description');
            }
        });

        // Remove service item
        $(document).on('click', '.remove-service-item', function() {
            $(this).closest('.service-item-card').remove();
        });
    });
</script>
@stop
