@extends('admin.layouts.app')
@section('content')
<!-- Page title -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-auto">
            <!-- Page pre-title -->
            <h2 class="page-title">
                Edit: <abbr>{{ $item->gender_title }}</abbr>
            </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ml-auto d-print-none">
            <a href="{{ url('admin/genders') }}" class="btn btn-primary btn-sm d-sm-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1"></path></svg>
                Return
            </a>
        </div>
    </div>
</div>
<div class="row row-deck row-cards">
    <div class="col-lg-12">
        
        <div class="card">
        
            <form method="post" action="{{ url('admin/gender/edit/'.$item->id) }}">
                <div class="card-body">
                    @csrf
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Title</label>
                        <div class="col">
                            <input type="text" class="form-control @error('gender_title') is-invalid @enderror" value="{{ !empty(old('gender_title')) ? old('gender_title') : $item->gender_title }}" name="gender_title">

                            @error('gender_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Color</label>
                            <div class="col">
                                <label class="form-colorinput">
                                    <input name="gender_color" type="radio" value="green" class="form-colorinput-input" {{$item->gender_color == 'green' ? 'checked' : '' }}>
                                    <span class="form-colorinput-color bg-green"></span>
                                </label>
                                
                                <label class="form-colorinput">
                                    <input name="gender_color" type="radio" value="red" class="form-colorinput-input" {{$item->gender_color == 'red' ? 'checked' : '' }}>
                                    <span class="form-colorinput-color bg-red"></span>
                                </label>
                                
                                <label class="form-colorinput">
                                    <input name="gender_color" type="radio" value="orange" class="form-colorinput-input" {{$item->gender_color == 'orange' ? 'checked' : '' }}>
                                    <span class="form-colorinput-color bg-orange"></span>
                                </label>
                                
                                <label class="form-colorinput">
                                    <input name="gender_color" type="radio" value="blue" class="form-colorinput-input" {{$item->gender_color == 'blue' ? 'checked' : '' }}>
                                    <span class="form-colorinput-color bg-blue"></span>
                                </label>
                                
                                <label class="form-colorinput">
                                    <input name="gender_color" type="radio" value="yellow" class="form-colorinput-input" {{$item->gender_color == 'yellow' ? 'checked' : '' }}>
                                    <span class="form-colorinput-color bg-yellow"></span>
                                </label>
                                
                                <label class="form-colorinput">
                                    <input name="gender_color" type="radio" value="gray" class="form-colorinput-input" {{$item->gender_color == 'gray' ? 'checked' : '' }}>
                                    <span class="form-colorinput-color bg-gray"></span>
                                </label>
                                
                                <label class="form-colorinput">
                                    <input name="gender_color" type="radio" value="azure" class="form-colorinput-input" {{$item->gender_color == 'azure' ? 'checked' : '' }}>
                                    <span class="form-colorinput-color bg-azure"></span>
                                </label>
                                
                                <label class="form-colorinput">
                                    <input name="gender_color" type="radio" value="purple" class="form-colorinput-input" {{$item->gender_color == 'purple' ? 'checked' : '' }}>
                                    <span class="form-colorinput-color bg-purple"></span>
                                </label>
                                
                                <label class="form-colorinput">
                                    <input name="gender_color" type="radio" value="cyan" class="form-colorinput-input" {{$item->gender_color == 'cyan' ? 'checked' : '' }}>
                                    <span class="form-colorinput-color bg-cyan"></span>
                                </label>
                                
                                <label class="form-colorinput">
                                    <input name="gender_color" type="radio" value="lime" class="form-colorinput-input" {{$item->gender_color == 'lime' ? 'checked' : '' }}>
                                    <span class="form-colorinput-color bg-lime"></span>
                                </label>
                                
                                <label class="form-colorinput">
                                    <input name="gender_color" type="radio" value="pink" class="form-colorinput-input" {{$item->gender_color == 'pink' ? 'checked' : '' }}>
                                    <span class="form-colorinput-color bg-pink"></span>
                                </label>
                                
                                <label class="form-colorinput">
                                    <input name="gender_color" type="radio" value="indigo" class="form-colorinput-input" {{$item->gender_color == 'indigo' ? 'checked' : '' }}>
                                    <span class="form-colorinput-color bg-indigo"></span>
                                </label>
                                
                                <label class="form-colorinput">
                                    <input name="gender_color" type="radio" value="dark" class="form-colorinput-input" {{$item->gender_color == 'dark' ? 'checked' : '' }}>
                                    <span class="form-colorinput-color bg-dark"></span>
                                </label>
                                
                                @error('gender_color')
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