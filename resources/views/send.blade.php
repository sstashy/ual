@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ url('send') }}" enctype="multipart/form-data">
                @csrf
                        
                <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" name="title" placeholder="{{ __('app.text_23') }}">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <div class="card mt-4">
                    <div class="card-body">
                        <textarea class="form-control form-control-flush @error('story') is-invalid @enderror" id="story" name="story" rows="5" minlength="{{ App\Settings::first()->min_chars_story }}" maxlength="{{ App\Settings::first()->max_chars_story }}" placeholder="{{ __('app.text_24') }}">{{ old('story') }}</textarea>
                        
                        @error('story')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                        <div class="row align-items-center mt-2">
                            <div class="col text-muted small">
                                <span id="rchars">{{ App\Settings::first()->max_chars_story }}</span>/{{ App\Settings::first()->max_chars_story }}
                            </div>
                            
                            <div class="col-auto text-muted">
                                By submitting this story, you agree to the <a href="{{ url('page/rules-fadwhaer') }}" target="_blank" class="text-muted strong"><u>rules</u></a> and <a href="{{ url('page/terms-and-conditions-swl0cy55') }}" target="_blank" class="text-muted strong"><u>terms and conditions</u></a>.
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        @if(App\Settings::first()->photo_upload == 1)
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M7 18a4.6 4.4 0 0 1 0 -9h0a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1"></path><polyline points="9 15 12 12 15 15"></polyline><line x1="12" y1="12" x2="12" y2="21"></line></svg> {{ __('app.text_22') }} <sup>*</sup></label>
                            <div class="col">

                                    <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" />
                                
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="ribbon ribbon-top bg-orange" data-toggle="tooltip" data-placement="left" title="{{ __('app.text_21') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon mt-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        </div>
                        @else
                        
                        @endif

                        <div class="form-group row">
                            <label class="form-label col-3 col-form-label"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M9 4h3l2 2h5a2 2 0 0 1 2 2v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2"></path><path d="M17 17v2a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2h2"></path></svg> {{ __('app.text_9') }}</label>
                            <div class="col">
                                <div class="form-selectgroup">
                                    @foreach($categories as $category)
                                        <label class="form-selectgroup-item">
                                            <input type="radio" id="categories" name="categories" value="{{ $category->id }}" class="form-selectgroup-input" {{ old('categories') == $category->id ? 'checked' : '' }}>
                                            <span class="form-selectgroup-label">
                                                {{ $category->name }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                                
                                @error('categories')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
 
                <div class="d-flex col">
                    <button type="submit" class="btn btn-primary ml-auto">{{ __('app.text_18') }}</button>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection