@extends('admin.layouts.app')
@section('content')
<!-- Page title -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-auto">
            <!-- Page pre-title -->
            <h2 class="page-title">
                Edit: <abbr>{{ $item->title }}</abbr>
            </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ml-auto d-print-none">
            <a href="{{ url('admin/items') }}" class="btn btn-primary btn-sm d-sm-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1"></path></svg>
                Return
            </a>
        </div>
    </div>
</div>
<div class="row row-deck row-cards">
    <div class="col-lg-12">
        
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Item</h3>
            </div>
    
            <form method="POST" action="{{ url('admin/item/edit/'.$item->id) }}">
                <div class="card-body">
                    @csrf
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Title</label>
                        <div class="col">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ !empty(old('title')) ? old('title') : $item->title }}" name="title">

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Categories</label>
                        <div class="col">
                            @foreach($categories as $category)
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="categories" value="{{ $category->id }}" {{ $item->categories == $category->id ? 'checked' : '' }}>
                                <span class="form-check-label">{{ $category->name }}</span>
                            </label>
                            @endforeach
                            
                            @error('categories')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Gender</label>
                        <div class="col">
                            @foreach($genders as $gender)
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="{{ $gender->id }}" {{ $item->gender == $gender->id ? 'checked' : '' }}>
                                <span class="form-check-label">{{ $gender->gender_title }}</span>
                            </label>
                            @endforeach
                            
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label">
                            Story
                        </label>
                        <div class="col">
                            <textarea class="form-control @error('story') is-invalid @enderror" name="story" rows="10">{{ !empty(old('story')) ? old('story') : $item->story }}</textarea>
                            
                            @error('story')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Status</label>
                        <div class="col">
                            
                       
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" value="1" @if($item->status == 1) checked="checked" @endif>
                                <span class="form-check-label">Active</span>
                            </label>
                            
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" value="2" @if($item->status == 2) checked="checked" @endif>
                                <span class="form-check-label">Disabled</span>
                            </label>
                            
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                </div>
                
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>
        </div>
        
    </div>
</div>
@endsection