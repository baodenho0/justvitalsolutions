@extends('layouts.app')

@section('content')
<section class="cover fullscreen image-bg overlay">
    <div class="background-image-holder">
        <img alt="image" class="background-image" src="{{ asset('img/home14.jpg') }}" />
    </div>
    <div class="container v-align-transform">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="feature bordered text-center">
                    <h4 class="uppercase">Reset Password</h4>
                    <form class="text-left" method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <input class="mb0 @error('email') error @enderror" type="text" name="email" placeholder="Email Address" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus />
                        @error('email')
                            <span class="text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror

                        <input class="mb0 @error('password') error @enderror" type="password" name="password" placeholder="Password" required autocomplete="new-password" />
                        @error('password')
                            <span class="text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror

                        <input class="mb0" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />

                        <input type="submit" value="Reset Password" class="btn-filled" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
