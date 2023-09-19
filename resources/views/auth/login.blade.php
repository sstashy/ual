@php
$auth_title = __('Login')
@endphp
@extends('auth.layouts.app')
@section('content')
<div class="container-tight py-6">

    <div class="text-center mb-4">
        <a href="{{ url('/') }}">
            <h2 class="text-muted">
                {{ App\Settings::first()->website_name }}
            </h2>
        </a>
    </div>

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">{{ __('Login') }}</h3>
        </div>

        <form method="POST" action="{{ route('login') }}">
            <div class="card-body">
                @csrf
                <div class="form-group mb-3 row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-footer text-right">
                <div class="d-flex">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    <button type="submit" class="btn btn-primary ml-auto">
                        {{ __('Login') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<link rel="stylesheet" href="{{ asset('resources/views/auth/login.css') }}">

@endsection
