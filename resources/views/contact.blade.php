@extends('layouts.app')

@section('content')
    <!-- Page Title -->
    <section class="page-title page-title-2 image-bg overlay parallax">
        <div class="background-image-holder">
            @if($contact->banner_image)
                <img alt="Background Image" class="background-image" src="{{ asset($contact->banner_image) }}" />
            @else
                <img alt="Background Image" class="background-image" src="{{ asset('img/home10.jpg') }}" />
            @endif
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="uppercase mb8">{{ $contact->title }}</h2>
                    <p class="lead mb0">{{ $contact->subtitle }}</p>
                </div>
                <div class="col-md-6 text-right">
                    <ol class="breadcrumb breadcrumb-2">
                        <li>
                            <a href="{{ route('landing-page') }}">Home</a>
                        </li>
                        <li class="active">{{ $contact->title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Info Section -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="uppercase">Get In Touch</h4>
                    @if($contact->intro_text)
                        <p class="lead">{!! $contact->intro_text !!}</p>
                    @else
                        <p class="lead">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.</p>
                    @endif
                    <p>
                        @if($contact->address)
                            <strong>Address:</strong> {{ $contact->address }}<br>
                        @endif
                        @if($contact->phone)
                            <strong>Phone:</strong> {{ $contact->phone }}<br>
                        @endif
                        @if($contact->email)
                            <strong>Email:</strong> {{ $contact->email }}<br>
                        @endif
                    </p>

                    @if(isset($contact->office_hours) && is_array($contact->office_hours) && count($contact->office_hours) > 0)
                        <h4 class="uppercase mt40">Office Hours</h4>
                        <ul class="list-unstyled">
                            @foreach($contact->office_hours as $hours)
                                <li><strong>{{ $hours['day'] ?? 'Day' }}:</strong> {{ $hours['hours'] ?? 'Hours' }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                @if($contact->show_contact_form)
                <div class="col-sm-6">
                    <form class="form-email" action="{{ route('contact.store') }}" method="post" data-success="Thanks for your submission, we will be in touch shortly." data-error="Please fill all required fields.">
                        @csrf
                        <h4 class="uppercase">{{ $contact->form_title ?? 'Send a message' }}</h4>
                        @if($contact->form_description)
                            <p>{!! $contact->form_description !!}</p>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <input type="text" class="form-control" name="name" placeholder="Name" required>
                        <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                        <input type="text" class="form-control" name="subject" placeholder="Subject">
                        <input type="text" class="form-control" name="phone" placeholder="Phone Number">
                        <input type="text" class="form-control" name="company" placeholder="Company Name">
                        <textarea class="form-control" name="message" placeholder="Your Message" rows="4" required></textarea>
                        <button type="submit" class="btn btn-filled btn-primary">Send Message</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Map Section -->
    @if($contact->map_embed_code)
    <section class="p0">
        <div class="map-holder">
            <div class="map-canvas" style="height: 400px;">
                {!! $contact->map_embed_code !!}
            </div>
        </div>
    </section>
    @endif
@endsection
