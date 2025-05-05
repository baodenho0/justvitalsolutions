@extends('adminlte::page')

@section('title', 'About Us Page')

@section('content_header')
    <h1>About Us Page</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">About Us Page Settings</h3>
            <div class="card-tools">
                <a href="{{ route('admin.about-us.edit') }}" class="btn btn-primary btn-sm">
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
                        <p>{{ $aboutUs->title ?? 'Not set' }}</p>
                    </div>
                    <div class="form-group">
                        <label>Subtitle</label>
                        <p>{{ $aboutUs->subtitle ?? 'Not set' }}</p>
                    </div>
                    <div class="form-group">
                        <label>Banner Image</label>
                        @if($aboutUs->banner_image)
                            <div>
                                <img src="{{ asset($aboutUs->banner_image) }}" alt="Banner Image" class="img-fluid" style="max-height: 200px;">
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
                            @if($aboutUs->is_active ?? false)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Section 1</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title</label>
                                <p>{{ $aboutUs->section1_title ?? 'Not set' }}</p>
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <div>{!! $aboutUs->section1_content ?? 'Not set' !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Section 2</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title</label>
                                <p>{{ $aboutUs->section2_title ?? 'Not set' }}</p>
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <div>{!! $aboutUs->section2_content ?? 'Not set' !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Skills</h4>
                        </div>
                        <div class="card-body">
                            @if(isset($aboutUs->skills) && is_array($aboutUs->skills) && count($aboutUs->skills) > 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Skill Name</th>
                                            <th>Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($aboutUs->skills as $skill)
                                            <tr>
                                                <td>{{ $skill['name'] ?? 'Unnamed' }}</td>
                                                <td>{{ $skill['percentage'] ?? '0' }}%</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>No skills defined</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Team Members</h4>
                        </div>
                        <div class="card-body">
                            @if(isset($aboutUs->team_members) && is_array($aboutUs->team_members) && count($aboutUs->team_members) > 0)
                                <div class="row">
                                    @foreach($aboutUs->team_members as $member)
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    @if(isset($member['image']))
                                                        <img src="{{ asset($member['image']) }}" alt="{{ $member['name'] ?? 'Team Member' }}" class="img-fluid rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                                                    @endif
                                                    <h5 class="mt-3">{{ $member['name'] ?? 'Unnamed' }}</h5>
                                                    <p>{{ $member['position'] ?? 'No position' }}</p>
                                                    @if(isset($member['bio']))
                                                        <p class="small">{{ $member['bio'] }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>No team members defined</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
