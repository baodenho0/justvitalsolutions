@extends('layouts.app')

@section('content')
    @foreach($sections as $section)
        @include('sections.' . $section->section_type, ['section' => $section])
    @endforeach
@endsection
