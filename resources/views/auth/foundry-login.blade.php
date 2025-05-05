@extends('layouts.app')

@section('content')
<section class="cover fullscreen image-bg overlay">
    <div class="background-image-holder">
        <img alt="image" class="background-image" src="{{ asset('img/home12.jpg') }}" />
    </div>
    <div class="container v-align-transform">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
                <div class="feature bordered text-center">
                    <h4 class="uppercase">Login Here</h4>
                    @if(session('error'))
                        <div class="alert alert-danger mb16">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form class="text-left" method="POST" action="{{ route('login') }}">
                        @csrf
                        <input class="mb0 @error('email') error @enderror" type="text" name="email" placeholder="Email Address" value="{{ old('email') }}" required autocomplete="email" autofocus />
                        @error('email')
                            <span class="text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror

                        <input class="mb0 @error('password') error @enderror" type="password" name="password" placeholder="Password" required autocomplete="current-password" />
                        @error('password')
                            <span class="text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror

                        <div class="checkbox mb8 mt8">
                            <label>
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                Remember Me
                            </label>
                        </div>

                        <input type="submit" value="Login" class="btn-filled" />
                    </form>
                    <p class="mb0">
                        @if (Route::has('password.request'))
                            Forgot your password?
                            <a href="{{ route('password.request') }}">Click Here To Reset</a>
                        @endif
                    </p>
                    <p class="mb0 mt8">
                        Don't have an account?
                        <a href="{{ route('register') }}">Register Here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
