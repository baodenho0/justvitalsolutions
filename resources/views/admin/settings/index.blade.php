@extends('adminlte::page')

@section('title', 'Site Settings')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Site Settings</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Site Settings</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Setting Groups</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.settings.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Add New
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            @foreach($groups as $group)
                                <li class="nav-item">
                                    <a href="{{ route('admin.settings.index', ['group' => $group]) }}" class="nav-link {{ $currentGroup == $group ? 'active' : '' }}">
                                        <i class="fas fa-{{ $group == 'general' ? 'cog' : ($group == 'social' ? 'share-alt' : ($group == 'contact' ? 'envelope' : ($group == 'appearance' ? 'palette' : 'sliders-h'))) }}"></i>
                                        {{ ucfirst($group) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ ucfirst($currentGroup) }} Settings</h3>
                    </div>
                    <form action="{{ route('admin.settings.update-batch') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="group" value="{{ $currentGroup }}">
                        <div class="card-body">
                            @if($settings->isEmpty())
                                <div class="alert alert-info">
                                    No settings found in this group. Click "Add New" to create settings.
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 25%">Setting</th>
                                                <th style="width: 50%">Value</th>
                                                <th style="width: 25%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($settings as $setting)
                                                <tr>
                                                    <td>
                                                        <strong>{{ ucwords(str_replace('_', ' ', $setting->key)) }}</strong>
                                                        <br>
                                                        <small class="text-muted">{{ $setting->key }}</small>
                                                    </td>
                                                    <td>
                                                        @if($setting->type == 'text')
                                                            <input type="text" class="form-control" name="{{ $setting->key }}" value="{{ $setting->value }}">
                                                        @elseif($setting->type == 'textarea')
                                                            <textarea class="form-control" name="{{ $setting->key }}" rows="3">{{ $setting->value }}</textarea>
                                                        @elseif($setting->type == 'boolean')
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="{{ $setting->key }}" name="{{ $setting->key }}" value="1" {{ $setting->value ? 'checked' : '' }}>
                                                                <label class="custom-control-label" for="{{ $setting->key }}">{{ $setting->value ? 'Enabled' : 'Disabled' }}</label>
                                                            </div>
                                                        @elseif($setting->type == 'number')
                                                            <input type="number" class="form-control" name="{{ $setting->key }}" value="{{ $setting->value }}">
                                                        @elseif($setting->type == 'image')
                                                            @if($setting->value)
                                                                <div class="mb-2">
                                                                    <img src="{{ asset( $setting->value) }}" alt="{{ $setting->key }}" class="img-thumbnail" style="max-height: 100px;">
                                                                </div>
                                                            @endif
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="{{ $setting->key }}_file" name="{{ $setting->key }}_file">
                                                                    <label class="custom-file-label" for="{{ $setting->key }}_file">Choose file</label>
                                                                </div>
                                                            </div>
                                                        @elseif($setting->type == 'color')
                                                            <input type="color" class="form-control" name="{{ $setting->key }}" value="{{ $setting->value }}">
                                                        @elseif($setting->type == 'json' && $setting->key == 'menu_items')
                                                            <div id="menu-items-container">
                                                                @php
                                                                    $menuItems = [];
                                                                    if ($setting->value) {
                                                                        if (is_string($setting->value)) {
                                                                            try {
                                                                                $menuItems = json_decode($setting->value, true) ?: [];
                                                                            } catch (\Exception $e) {
                                                                                $menuItems = [];
                                                                            }
                                                                        } elseif (is_array($setting->value)) {
                                                                            $menuItems = $setting->value;
                                                                        }
                                                                    }
                                                                @endphp

                                                                @foreach($menuItems as $index => $item)
                                                                    <div class="menu-item-row mb-2">
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" name="{{ $setting->key }}[{{ $index }}][text]" value="{{ $item['text'] ?? '' }}" placeholder="Menu Text">
                                                                            <input type="text" class="form-control" name="{{ $setting->key }}[{{ $index }}][url]" value="{{ $item['url'] ?? '' }}" placeholder="URL">
                                                                            <div class="input-group-append">
                                                                                <button type="button" class="btn btn-danger remove-menu-item"><i class="fas fa-times"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                                <template id="menu-item-template">
                                                                    <div class="menu-item-row mb-2">
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" name="{{ $setting->key }}[INDEX][text]" placeholder="Menu Text">
                                                                            <input type="text" class="form-control" name="{{ $setting->key }}[INDEX][url]" placeholder="URL">
                                                                            <div class="input-group-append">
                                                                                <button type="button" class="btn btn-danger remove-menu-item"><i class="fas fa-times"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </template>

                                                                <button type="button" class="btn btn-sm btn-success" id="add-menu-item">
                                                                    <i class="fas fa-plus"></i> Add Menu Item
                                                                </button>
                                                            </div>
                                                        @elseif($setting->type == 'json')
                                                            <textarea class="form-control" name="{{ $setting->key }}" rows="5">{{ $setting->value }}</textarea>
                                                            <small class="form-text text-muted">Enter valid JSON</small>
                                                        @else
                                                            <input type="text" class="form-control" name="{{ $setting->key }}" value="{{ $setting->value }}">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{ route('admin.settings.edit', $setting) }}" class="btn btn-sm btn-info">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $setting->id }}">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </button>
                                                        </div>

                                                        <!-- Delete Modal -->
                                                        <div class="modal fade" id="deleteModal{{ $setting->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to delete the setting "{{ $setting->key }}"?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                        <form action="{{ route('admin.settings.destroy', $setting) }}" method="POST" style="display: inline;">
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
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save All Settings</button>
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

            // Menu items functionality
            let menuItemIndex = 0;
                $menuItemsSetting = $settings->where('key', 'menu_items')->first();
                $menuItems = [];

                if ($menuItemsSetting && $menuItemsSetting->value) {
                    if (is_string($menuItemsSetting->value)) {
                        try {
                            $menuItems = json_decode($menuItemsSetting->value, true) ?: [];
                        } catch (\Exception $e) {
                            $menuItems = [];
                        }
                    } elseif (is_array($menuItemsSetting->value)) {
                        $menuItems = $menuItemsSetting->value;
                    }
                }

                count($menuItems)
            }};

            $('#add-menu-item').on('click', function() {
                const template = $('#menu-item-template').html().replace(/INDEX/g, menuItemIndex++);
                $('#menu-items-container').append(template);
            });

            $(document).on('click', '.remove-menu-item', function() {
                $(this).closest('.menu-item-row').remove();
            });

            // Flash message auto-hide
            $('.alert-dismissible').fadeTo(5000, 500).slideUp(500);
        });
    </script>
@stop
