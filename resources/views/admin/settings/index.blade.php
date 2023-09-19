@extends('admin.layouts.app')
@section('content')
<!-- Page title -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-auto">
            <h2 class="page-title">
                Settings
            </h2>
        </div>
    </div>
</div>
<div class="row row-deck row-cards">

        
    <form method="post" action="{{ url('admin/settings') }}" enctype="multipart/form-data">
    @csrf

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">General</h3>
            </div>
            <div class="card-body">

                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Logo</label>
                    <div class="col">
                        @if(!$settings->logo == NULL)
                        <img src="{{ url('dist/img/logo/'.$settings->logo) }}" class="img-thumbnail mb-2" width="100px" height="100px">
                        <div class="mb-2">
                            <a href="{{ url('admin/settings/delete_logo') }}" class="btn btn-sm btn-danger">
                                {{ __('app.text_42') }}
                            </a>
                        </div>
                        @endif
                        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
                        <small class="form-hint">This field is optional. If you don't upload a logo, a text logo will be shown.</small>

                        @error('logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Website Name</label>
                    <div class="col">
                        <input type="text" class="form-control @error('website_name') is-invalid @enderror" value="{{ !empty(old('website_name')) ? old('website_name') : $settings->website_name }}" name="website_name">
                        <small class="form-hint">Set the Name you want to give to your website.</small>

                        @error('website_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Website Tagline</label>
                    <div class="col">
                        <input type="text" class="form-control @error('website_tagline') is-invalid @enderror" value="{{ !empty(old('website_tagline')) ? old('website_tagline') : $settings->website_tagline }}" name="website_tagline">
                        <small class="form-hint">Set the Tagline you want to give to your website.</small>

                        @error('website_tagline')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Website Description</label>
                    <div class="col">
                        <textarea class="form-control @error('website_desc') is-invalid @enderror" data-toggle="autosize" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 56px;" name="website_desc">{{ !empty(old('website_desc')) ? old('website_desc') : $settings->website_desc }}</textarea>
                        <small class="form-hint">Set the Description you want to give to your website.</small>

                        @error('website_desc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Analytics</label>
                    <div class="col">
                        <input type="text" class="form-control @error('analytics') is-invalid @enderror" value="{{ !empty(old('analytics')) ? old('analytics') : $settings->analytics }}" name="analytics" placeholder="UA-">
                        <small class="form-hint">Just enter the code after <mark>UA-</mark> from your Tracking ID.</small>

                        @error('analytics')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>

               <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Direction</label>
                    <div class="col mt-2">
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="dir" value="ltr" @if($settings->dir == 'ltr') checked="checked" @endif>
                            <span class="form-check-label">Left To Right</span>
                        </label>

                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="dir" value="rtl" @if($settings->dir == 'rtl') checked="checked" @endif>
                            <span class="form-check-label">Right To Left</span>
                        </label>

                        @error('dir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Settings</h3>
            </div>

            <div class="card-body">

                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Items Status</label>
                    <div class="col mt-2">
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="items_status" value="1" @if($settings->items_status == 1) checked="checked" @endif>
                            <span class="form-check-label">Yes</span>
                        </label>

                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="items_status" value="2" @if($settings->items_status == 2) checked="checked" @endif>
                            <span class="form-check-label">Moderation</span>
                        </label>

                        <small class="form-hint">By marking "Yes" the new items sent will be automatically visible to the public.</small>

                        @error('items_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>
                
                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Comments Status</label>
                    <div class="col mt-2">
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="comments_status" value="1" @if($settings->comments_status == 1) checked="checked" @endif>
                            <span class="form-check-label">Visible</span>
                        </label>

                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="comments_status" value="2" @if($settings->comments_status == 2) checked="checked" @endif>
                            <span class="form-check-label">Moderation</span>
                        </label>

                        <small class="form-hint">Refers to newly entered comments, if immediately visible or moved to moderation.</small>

                        @error('comments_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Photo Upload</label>
                    <div class="col mt-2">
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="photo_upload" value="1" @if($settings->photo_upload == 1) checked="checked" @endif>
                            <span class="form-check-label">Yes</span>
                        </label>

                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="photo_upload" value="2" @if($settings->photo_upload == 2) checked="checked" @endif>
                            <span class="form-check-label">No</span>
                        </label>

                        <small class="form-hint">By marking "Yes" it will be possible to upload a photo for the stories.</small>

                        @error('photo_upload')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Items Result</label>
                    <div class="col">
                        <input type="number" class="form-control @error('items_result') is-invalid @enderror" value="{{ !empty(old('items_result')) ? old('items_result') : $settings->items_result }}" name="items_result">
                        <small class="form-hint">Set how many results per page to show</small>

                        @error('items_result')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>
                
                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Maximum Title Chars</label>
                    <div class="col">
                        <input type="number" class="form-control @error('max_chars_title') is-invalid @enderror" value="{{ !empty(old('max_chars_title')) ? old('max_chars_title') : $settings->max_chars_title }}" name="max_chars_title">
                        <small class="form-hint">Set the maximum characters for the story title.</small>

                        @error('max_chars_title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Min/Max Story Chars</label>
                    <div class="col">
                        <input type="number" class="form-control @error('min_chars_story') is-invalid @enderror" value="{{ !empty(old('min_chars_story')) ? old('min_chars_story') : $settings->min_chars_story }}" name="min_chars_story">
                        <small class="form-hint">Set the <strong>minimum</strong> characters for the story body.</small>

                        @error('min_chars_story')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <div class="col">
                        <input type="number" class="form-control @error('max_chars_story') is-invalid @enderror" value="{{ !empty(old('max_chars_story')) ? old('max_chars_story') : $settings->max_chars_story }}" name="max_chars_story">
                        <small class="form-hint">Set the <strong>maximum</strong> characters for the story body.</small>

                        @error('max_chars_story')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>


                </div>

            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><rect x="3" y="5" width="18" height="14" rx="2"></rect><path d="M7 15v-4a2 2 0 0 1 4 0v4"></path><line x1="7" y1="13" x2="11" y2="13"></line><path d="M17 9v6h-1.5a1.5 1.5 0 1 1 1.5 -1.5"></path></svg> Advertisements</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Adv 1</label>
                    <div class="col">
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="adv_1" value="" {{ $settings->adv_2 == NULL ? 'checked' : '' }}>
                            <span class="form-check-label" data-toggle="tooltip" data-placement="bottom" title="Disable this ADV block"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></span>
                        </label>
                        @foreach($advertisements as $adv)
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="adv_1" value="{{ $adv->id }}" {{ $settings->adv_1 == $adv->id ? 'checked' : '' }}>
                            <span class="form-check-label strong">{{ $adv->title }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                
                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Adv 2</label>
                    <div class="col">
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="adv_2" value="" {{ $settings->adv_2 == NULL ? 'checked' : '' }}>
                            <span class="form-check-label" data-toggle="tooltip" data-placement="bottom" title="Disable this ADV block"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></span>
                        </label>
                        @foreach($advertisements as $adv)
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="adv_2" value="{{ $adv->id }}" {{ $settings->adv_2 == $adv->id ? 'checked' : '' }}>
                            <span class="form-check-label strong">{{ $adv->title }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                
            </div>
            
        </div>
        
        <small class="text-muted">Last update: {{ $settings->updated_at }}</small>
        
        <div class="form-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>

    </form>    
    
</div>
@endsection