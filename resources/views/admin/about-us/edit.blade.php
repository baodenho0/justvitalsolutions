@extends('admin.layouts.admin')

@section('title', 'Edit About Us Page')

@section('content_header')
    <h1>Edit About Us Page</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit About Us Page</h3>
            <div class="card-tools">
                <a href="{{ route('admin.about-us.index') }}" class="btn btn-default btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.about-us.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $aboutUs->title ?? 'About Us') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="subtitle">Subtitle</label>
                            <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle" value="{{ old('subtitle', $aboutUs->subtitle ?? '') }}">
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="banner_image">Banner Image</label>
                            @if($aboutUs->banner_image ?? false)
                                <div class="mb-2">
                                    <img src="{{ asset($aboutUs->banner_image) }}" alt="Current Banner" class="img-fluid" style="max-height: 200px;">
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
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ (old('is_active', $aboutUs->is_active ?? true) ? 'checked' : '') }}>
                                <label class="custom-control-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="section1_title">Section 1 Title</label>
                            <input type="text" class="form-control @error('section1_title') is-invalid @enderror" id="section1_title" name="section1_title" value="{{ old('section1_title', $aboutUs->section1_title ?? 'Diversity & Difference') }}">
                            @error('section1_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="section1_content">Section 1 Content</label>
                            <textarea class="form-control @error('section1_content') is-invalid @enderror" id="section1_content" name="section1_content" rows="5">{{ old('section1_content', $aboutUs->section1_content ?? '') }}</textarea>
                            @error('section1_content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="section2_title">Section 2 Title</label>
                            <input type="text" class="form-control @error('section2_title') is-invalid @enderror" id="section2_title" name="section2_title" value="{{ old('section2_title', $aboutUs->section2_title ?? 'Service Spread') }}">
                            @error('section2_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="section2_content">Section 2 Content</label>
                            <textarea class="form-control @error('section2_content') is-invalid @enderror" id="section2_content" name="section2_content" rows="5">{{ old('section2_content', $aboutUs->section2_content ?? '') }}</textarea>
                            @error('section2_content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Skills</h4>
                                <button type="button" class="btn btn-sm btn-primary float-right" id="add-skill">Add Skill</button>
                            </div>
                            <div class="card-body">
                                <div id="skills-container">
                                    @if(isset($aboutUs->skills) && is_array($aboutUs->skills) && count($aboutUs->skills) > 0)
                                        @foreach($aboutUs->skills as $index => $skill)
                                            <div class="row skill-row mb-3">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="skills[{{ $index }}][name]" placeholder="Skill Name" value="{{ $skill['name'] ?? '' }}">
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" name="skills[{{ $index }}][percentage]" placeholder="Percentage" min="0" max="100" value="{{ $skill['percentage'] ?? '' }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger remove-skill">Remove</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="row skill-row mb-3">
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="skills[0][name]" placeholder="Skill Name" value="Branding">
                                            </div>
                                            <div class="col-md-5">
                                                <input type="number" class="form-control" name="skills[0][percentage]" placeholder="Percentage" min="0" max="100" value="90">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger remove-skill">Remove</button>
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
                                <h4>Team Members</h4>
                                <button type="button" class="btn btn-sm btn-primary float-right" id="add-team-member">Add Team Member</button>
                            </div>
                            <div class="card-body">
                                <div id="team-members-container">
                                    @if(isset($aboutUs->team_members) && is_array($aboutUs->team_members) && count($aboutUs->team_members) > 0)
                                        @foreach($aboutUs->team_members as $index => $member)
                                            <div class="card mb-4 team-member-card">
                                                <div class="card-header">
                                                    <h5>Team Member</h5>
                                                    <button type="button" class="btn btn-sm btn-danger float-right remove-team-member">Remove</button>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Name</label>
                                                                <input type="text" class="form-control" name="team_members[{{ $index }}][name]" placeholder="Name" value="{{ $member['name'] ?? '' }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Position</label>
                                                                <input type="text" class="form-control" name="team_members[{{ $index }}][position]" placeholder="Position" value="{{ $member['position'] ?? '' }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Bio</label>
                                                                <textarea class="form-control" name="team_members[{{ $index }}][bio]" rows="3" placeholder="Bio">{{ $member['bio'] ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Image</label>
                                                                @if(isset($member['image']))
                                                                    <div class="mb-2">
                                                                        <img src="{{ asset($member['image']) }}" alt="Team Member" class="img-fluid" style="max-height: 150px;">
                                                                        <input type="hidden" name="team_members[{{ $index }}][existing_image]" value="{{ $member['image'] }}">
                                                                    </div>
                                                                @endif
                                                                <input type="file" class="form-control-file" name="team_members[{{ $index }}][image]">
                                                                <small class="form-text text-muted">Recommended size: 400x400 pixels</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="{{ route('admin.about-us.index') }}" class="btn btn-default">Cancel</a>
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
            CKEDITOR.replace('section1_content');
            CKEDITOR.replace('section2_content');
        }

        // Add new skill
        $('#add-skill').click(function() {
            const skillsCount = $('.skill-row').length;
            const newSkill = `
                <div class="row skill-row mb-3">
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="skills[${skillsCount}][name]" placeholder="Skill Name">
                    </div>
                    <div class="col-md-5">
                        <input type="number" class="form-control" name="skills[${skillsCount}][percentage]" placeholder="Percentage" min="0" max="100">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-skill">Remove</button>
                    </div>
                </div>
            `;
            $('#skills-container').append(newSkill);
        });

        // Remove skill
        $(document).on('click', '.remove-skill', function() {
            $(this).closest('.skill-row').remove();
        });

        // Add new team member
        $('#add-team-member').click(function() {
            const teamMembersCount = $('.team-member-card').length;
            const newTeamMember = `
                <div class="card mb-4 team-member-card">
                    <div class="card-header">
                        <h5>Team Member</h5>
                        <button type="button" class="btn btn-sm btn-danger float-right remove-team-member">Remove</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="team_members[${teamMembersCount}][name]" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label>Position</label>
                                    <input type="text" class="form-control" name="team_members[${teamMembersCount}][position]" placeholder="Position">
                                </div>
                                <div class="form-group">
                                    <label>Bio</label>
                                    <textarea class="form-control" name="team_members[${teamMembersCount}][bio]" rows="3" placeholder="Bio"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control-file" name="team_members[${teamMembersCount}][image]">
                                    <small class="form-text text-muted">Recommended size: 400x400 pixels</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            $('#team-members-container').append(newTeamMember);
        });

        // Remove team member
        $(document).on('click', '.remove-team-member', function() {
            $(this).closest('.team-member-card').remove();
        });
    });
</script>
@stop
