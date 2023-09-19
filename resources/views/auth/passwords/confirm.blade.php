@php
$auth_title = __('Confirm Password')
@endphp
@extends('auth.layouts.app')
@section('content')
<div class="container-tight py-6">

    <div class="text-center mb-4">
        <h2>{{ App\Settings::first()->website_name }}</h2>
    </div>

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">{{ __('Confirm Password') }}</h3>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
            
            <div class="card-body">
            {{ __('Please confirm your password before continuing.') }}

                <div class="form-group mb-3 row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="card-footer text-right">
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary ml-auto">
                            {{ __('Confirm Password') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>    
            </div>
            
        </form>
    </div>
</div> 
@endsection