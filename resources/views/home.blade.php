@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Home</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Welcome to Laravel Admin Panel</h3>
        </div>
        <div class="card-body">
            <p>You are logged in!</p>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Go to Admin Dashboard</a>
        </div>
    </div>
@stop
