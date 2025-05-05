@extends('adminlte::page')

@section('title', 'Create Setting')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create Setting</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.settings.index') }}">Site Settings</a></li>
                    <li class="breadcrumb-item active">Create</li>
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
                        <h3 class="card-title">Add New Setting</h3>
                    </div>
                    <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="key">Setting Key</label>
                                <input type="text" class="form-control @error('key') is-invalid @enderror" id="key" name="key" value="{{ old('key') }}" required>
                                <small class="form-text text-muted">Use snake_case format (e.g., site_title, footer_text)</small>
                                @error('key')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="group">Group</label>
                                <select class="form-control @error('group') is-invalid @enderror" id="group" name="group" required>
                                    @foreach($groups as $group)
                                        <option value="{{ $group }}" {{ old('group') == $group ? 'selected' : '' }}>{{ ucfirst($group) }}</option>
                                    @endforeach
                                    <option value="new">Create New Group</option>
                                </select>
                                @error('group')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group" id="new-group-container" style="display: none;">
                                <label for="new_group">New Group Name</label>
                                <input type="text" class="form-control" id="new_group" name="new_group" value="{{ old('new_group') }}">
                                <small class="form-text text-muted">Use lowercase letters and underscores</small>
                            </div>

                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                                    @foreach($types as $value => $label)
                                        <option value="{{ $value }}" {{ old('type') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group" id="value-container">
                                <label for="value">Value</label>
                                <input type="text" class="form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ old('value') }}">
                                @error('value')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group" id="textarea-container" style="display: none;">
                                <label for="textarea_value">Value</label>
                                <textarea class="form-control @error('value') is-invalid @enderror" id="textarea_value" name="textarea_value" rows="5">{{ old('textarea_value') }}</textarea>
                                @error('value')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group" id="boolean-container" style="display: none;">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="boolean_value" name="boolean_value" value="1" {{ old('boolean_value') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="boolean_value">Enabled</label>
                                </div>
                            </div>

                            <div class="form-group" id="image-container" style="display: none;">
                                <label for="image">Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group" id="color-container" style="display: none;">
                                <label for="color_value">Color</label>
                                <input type="color" class="form-control @error('value') is-invalid @enderror" id="color_value" name="color_value" value="{{ old('color_value', '#000000') }}">
                                @error('value')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group" id="json-container" style="display: none;">
                                <label for="json_value">JSON Value</label>
                                <textarea class="form-control @error('value') is-invalid @enderror" id="json_value" name="json_value" rows="5">{{ old('json_value', '[]') }}</textarea>
                                <small class="form-text text-muted">Enter valid JSON</small>
                                @error('value')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.settings.index') }}" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
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
            // Enable custom file input
            bsCustomFileInput.init();

            // Handle type change
            $('#type').on('change', function() {
                const type = $(this).val();

                // Hide all value containers
                $('#value-container, #textarea-container, #boolean-container, #image-container, #color-container, #json-container').hide();

                // Show the appropriate container based on type
                if (type === 'text' || type === 'number') {
                    $('#value-container').show();
                } else if (type === 'textarea') {
                    $('#textarea-container').show();
                } else if (type === 'boolean') {
                    $('#boolean-container').show();
                } else if (type === 'image') {
                    $('#image-container').show();
                } else if (type === 'color') {
                    $('#color-container').show();
                } else if (type === 'json') {
                    $('#json-container').show();
                }
            });

            // Trigger change event to set initial state
            $('#type').trigger('change');

            // Handle group change
            $('#group').on('change', function() {
                if ($(this).val() === 'new') {
                    $('#new-group-container').show();
                } else {
                    $('#new-group-container').hide();
                }
            });

            // Trigger change event to set initial state
            $('#group').trigger('change');
        });
    </script>
@stop
