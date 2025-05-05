@extends('adminlte::auth.auth-page', ['authType' => 'login'])

@section('title', 'Admin Login')

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@section('auth_header', 'Admin Login')

@section('auth_body')
    <form action="{{ route('admin.login.submit') }}" method="post">
        @csrf

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" placeholder="Email" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="Password">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Login field --}}
        <div class="row">
            <div class="col-7">
                <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Remember Me</label>
                </div>
            </div>

            <div class="col-5">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-sign-in-alt mr-2"></i> Sign In
                </button>
            </div>
        </div>
    </form>
@stop

@section('auth_footer')
    <p class="my-0">
        <a href="{{ route('password.request') }}">
            I forgot my password
        </a>
    </p>
@stop

@section('css')
    <style>
        .login-page, .register-page {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .login-card-body, .register-card-body {
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .login-logo, .register-logo {
            margin-bottom: 1.5rem;
        }
        .login-logo a, .register-logo a {
            color: #fff;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #4a6cf7;
            border-color: #4a6cf7;
        }
        .btn-primary:hover {
            background-color: #3a5bd9;
            border-color: #3a5bd9;
        }
        .icheck-primary > input:first-child:checked + label::before {
            background-color: #4a6cf7;
            border-color: #4a6cf7;
        }
    </style>
@stop
