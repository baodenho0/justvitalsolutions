@extends('layouts.app')

@section('content')
    <!-- Page Title -->
    <section class="page-title page-title-4 image-bg overlay parallax">
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
                    <h3 class="uppercase mb0">{{ $contact->title ?? 'Contact Us' }}</h3>
                </div>
                <div class="col-md-6 text-right">
                    <ol class="breadcrumb breadcrumb-2">
                        <li>
                            <a href="{{ route('landing-page') }}">Home</a>
                        </li>
                        <li>
                            <a href="#">Pages</a>
                        </li>
                        <li class="active">{{ $contact->title ?? 'Contact' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    @if($contact->map_embed_code)
    <section class="p0">
        <div class="map-holder pt160 pb160">
            {!! $contact->map_embed_code !!}
        </div>
    </section>
    @else
    <section class="p0">
        <div class="map-holder pt160 pb160">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3149.4086040735224!2d144.976411!3d-37.87412599999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad66889faebddf1%3A0xcc68084b44a30620!2sRiva+St+Kilda!5e0!3m2!1sen!2sau!4v1427779902899"></iframe>
        </div>
    </section>
    @endif

    <!-- Contact Info Section -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-5">
                    <h4 class="uppercase">{{ $contact->info_title ?? 'Get In Touch' }}</h4>
                    @if($contact->intro_text)
                        <p>{!! $contact->intro_text !!}</p>
                    @else
                        <p>
                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident,
                        </p>
                    @endif
                    <hr>
                    <p>
                        @if($contact->address)
                            {{ $contact->address }}
                        @else
                            438 Marine Parade<br>
                            Elwood, Victoria<br>
                            P.O Box 3184
                        @endif
                    </p>
                    <hr>
                    <p>
                        <strong>E:</strong> {{ $contact->email ?? 'hello@foundry.net' }}<br>
                        <strong>P:</strong> {{ $contact->phone ?? '+614 3948 2726' }}<br>
                    </p>
                </div>

                <div class="col-sm-6 col-md-5 col-md-offset-1">
                    <form class="form-email" action="{{ route('contact.store') }}" method="post" data-success="Thanks for your submission, we will be in touch shortly." data-error="Please fill all fields correctly.">
                        @csrf
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <input type="text" class="validate-required" name="name" placeholder="Your Name" required />
                        <input type="text" class="validate-required validate-email" name="email" placeholder="Email Address" required />
                        <textarea class="validate-required" name="message" rows="4" placeholder="Message" required></textarea>
                        <button type="submit" class="btn btn-filled">{{ $contact->button_text ?? 'Send Message' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
