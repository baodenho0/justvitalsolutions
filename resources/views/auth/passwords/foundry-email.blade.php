@extends('layouts.app')

@section('content')
<section class="cover fullscreen image-bg overlay">
    <div class="background-image-holder">
        <img alt="image" class="background-image" src="{{ asset('img/home13.jpg') }}" />
    </div>
    <div class="container v-align-transform">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
                <div class="feature bordered text-center">
                    <h4 class="uppercase">Reset Password</h4>

                    @if (session('status'))
                        <div class="alert alert-success mb16" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="text-left" method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <input class="mb0 @error('email') error @enderror" type="text" name="email" placeholder="Email Address" value="{{ old('email') }}" required autocomplete="email" autofocus />
                        @error('email')
                            <span class="text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror

                        <input type="submit" value="Send Password Reset Link" class="btn-filled" />
                    </form>
                    <p class="mb0 mt8">
                        <a href="{{ route('login') }}">Back to Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
