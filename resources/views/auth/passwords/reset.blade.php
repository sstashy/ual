@php
$auth_title = __('Reset Password')
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
            <h3 class="card-title">{{ __('Reset Password') }}</h3>
        </div>

        <form method="POST" action="{{ route('password.update') }}">
        @csrf
            
            <div class="card-body">
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group mb-3 row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

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
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
            </div>

            <div class="card-footer text-right">
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary ml-auto">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </div>
            
        </form>
    </div>
</div>               
@endsection