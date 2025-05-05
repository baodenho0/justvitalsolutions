@extends('adminlte::page')

@section('title', 'View Submission')

@section('content_header')
    <h1>View Submission</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Submission Details</h3>
            <div class="card-tools">
                <a href="{{ route('admin.contact.submissions') }}" class="btn btn-default btn-sm">
                    <i class="fas fa-arrow-left"></i> Back to Submissions
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name</label>
                        <p>{{ $submission->name }}</p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p><a href="mailto:{{ $submission->email }}">{{ $submission->email }}</a></p>
                    </div>
                    <div class="form-group">
                        <label>Subject</label>
                        <p>{{ $submission->subject ?? 'No Subject' }}</p>
                    </div>
                    <div class="form-group">
                        <label>Date Submitted</label>
                        <p>{{ $submission->created_at->format('F d, Y H:i:s') }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone</label>
                        <p>{{ $submission->phone ?? 'Not provided' }}</p>
                    </div>
                    <div class="form-group">
                        <label>Company</label>
                        <p>{{ $submission->company ?? 'Not provided' }}</p>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <p>
                            @if($submission->read)
                                <span class="badge badge-success">Read</span>
                                @if($submission->read_at)
                                    <small class="text-muted ml-2">Read on {{ $submission->read_at->format('F d, Y H:i:s') }}</small>
                                @endif
                            @else
                                <span class="badge badge-warning">Unread</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Message</h4>
                        </div>
                        <div class="card-body">
                            <p style="white-space: pre-wrap;">{{ $submission->message }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <a href="mailto:{{ $submission->email }}?subject=Re: {{ $submission->subject ?? 'Your Contact Form Submission' }}" class="btn btn-primary">
                        <i class="fas fa-reply"></i> Reply via Email
                    </a>
                    <form action="{{ route('admin.contact.submissions.delete', $submission->id) }}" method="POST" class="d-inline ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this submission?')">
                            <i class="fas fa-trash"></i> Delete Submission
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
