@extends('layouts.app')

@section('content')
<section class="cover fullscreen image-bg overlay">
    <div class="background-image-holder">
        <img alt="image" class="background-image" src="{{ asset('img/home2.jpg') }}" />
    </div>
    <div class="container v-align-transform">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="feature bordered text-center">
                    <h4 class="uppercase">Register Here</h4>
                    <form class="text-left" method="POST" action="{{ route('register') }}">
                        @csrf

                        <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" class="@error('name') error @enderror" required autocomplete="name" autofocus />
                        @error('name')
                            <span class="text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror

                        <input type="text" name="email" placeholder="Email Address" value="{{ old('email') }}" class="@error('email') error @enderror" required autocomplete="email" />
                        @error('email')
                            <span class="text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror

                        <input type="password" name="password" placeholder="Password" class="@error('password') error @enderror" required autocomplete="new-password" />
                        @error('password')
                            <span class="text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror

                        <input type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />

                        <input type="submit" value="Register" class="btn-filled" />
                    </form>
                    <p class="mb0">By signing up, you agree to our
                        <a href="#">Terms Of Use</a>
                    </p>
                    <p class="mb0 mt8">
                        Already have an account?
                        <a href="{{ route('login') }}">Login Here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
