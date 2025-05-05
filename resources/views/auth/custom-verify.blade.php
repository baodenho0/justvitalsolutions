@extends('layouts.app')

@section('content')
<section class="cover fullscreen image-bg overlay">
    <div class="background-image-holder">
        <img alt="image" class="background-image" src="{{ asset('img/home15.jpg') }}" />
    </div>
    <div class="container v-align-transform">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="feature bordered text-center">
                    <h4 class="uppercase">{{ __('Verify Your Email Address') }}</h4>

                    @if (session('resent'))
                        <div class="alert alert-success mb16" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    <p class="mb16">
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                    </p>

                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-filled">{{ __('click here to request another') }}</button>.
                    </form>

                    <p class="mb0 mt16">
                        <a href="{{ route('home') }}">{{ __('Back to Home') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
