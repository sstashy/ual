@php
$auth_title = __('Register')
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

    <div class="card border-primary">
        <div class="card-header bg-primary">
            <h3 class="card-title text-white">{{ __('Register') }}</h3>
        </div>
        
        <form method="POST" action="{{ route('register') }}">
            <div class="card-body">
                @csrf
                
                <div class="form-group mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                    <div class="col">
                        <input id="name" type="text" class="form-control py-3 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group mb-3 row">
                    <label for="birth" class="col-md-4 col-form-label text-md-right">{{ __('Birth') }}</label>
                    <div class="col">
                        <input type="date" class="form-control @error('birth') is-invalid @enderror" value="{{ old('birth') }}" name="birth">

                        @error('birth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group mb-3 row text-center">
                    <div class="hr-text">{{ __('app.text_26') }}</div>
                    <div class="col">
                        <div class="form-selectgroup">
                            @php
                            use App\Genders;
                            $genders = Genders::all();
                            @endphp
                            @foreach($genders as $gender)
                            <label class="form-selectgroup-item">
                                <input type="radio" name="gender" value="{{ $gender->id }}" class="form-selectgroup-input" {{ old('gender') == $gender->id ? 'checked' : '' }}>
                                <span class="form-selectgroup-label">
                                    {{ $gender->gender_title }}
                                </span>
                            </label>
                            @endforeach
                        </div>

                        @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="hr-text">{{ __('Password') }}</div>

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
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
            
        </form>
    </div>


<!-- register.css dosyasını projenize dahil edin -->
<link rel="stylesheet" href="{{ asset('resources/views/auth/register.css') }}">
@endsection