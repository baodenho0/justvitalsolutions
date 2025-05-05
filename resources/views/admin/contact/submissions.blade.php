@extends('adminlte::page')

@section('title', 'Contact Form Submissions')

@section('content_header')
    <h1>Contact Form Submissions</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Contact Form Submissions</h3>
            <div class="card-tools">
                <a href="{{ route('admin.contact.index') }}" class="btn btn-default btn-sm">
                    <i class="fas fa-arrow-left"></i> Back to Contact Page
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($submissions->count() > 0)
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($submissions as $submission)
                            <tr>
                                <td>{{ $submission->id }}</td>
                                <td>{{ $submission->name }}</td>
                                <td>{{ $submission->email }}</td>
                                <td>{{ $submission->subject ?? 'No Subject' }}</td>
                                <td>{{ $submission->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    @if($submission->read)
                                        <span class="badge badge-success">Read</span>
                                    @else
                                        <span class="badge badge-warning">Unread</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.contact.submissions.show', $submission->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <form action="{{ route('admin.contact.submissions.delete', $submission->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this submission?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $submissions->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    No contact form submissions found.
                </div>
            @endif
        </div>
    </div>
@stop
