@extends('layouts.app')

@section('content')
<section class="cover fullscreen image-bg overlay">
    <div class="background-image-holder">
        <img alt="image" class="background-image" src="{{ asset('img/home16.jpg') }}" />
    </div>
    <div class="container v-align-transform">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
                <div class="feature bordered text-center">
                    <h4 class="uppercase">{{ __('Confirm Password') }}</h4>
                    <p class="mb16">{{ __('Please confirm your password before continuing.') }}</p>

                    <form class="text-left" method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <input class="mb0 @error('password') error @enderror" type="password" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password" />
                        @error('password')
                            <span class="text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror

                        <input type="submit" value="{{ __('Confirm Password') }}" />
                    </form>

                    <p class="mb0 mt8">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
