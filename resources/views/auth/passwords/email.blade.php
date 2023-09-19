@php
$auth_title = __('Reset Password')
@endphp
@extends('auth.layouts.app')
@section('content')
<div class="container-tight py-6">

    <div class="text-center mb-4">
        <h2>{{ App\Settings::first()->website_name }}</h2>
    </div>

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">{{ __('Reset Password') }}</h3>
        </div>

        <form method="POST" action="{{ route('password.email') }}">
        @csrf
            
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

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
            </div>
            
            <div class="card-footer text-right">
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary ml-auto">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </div>
            
        </form>
    </div>
</div>
@endsection
