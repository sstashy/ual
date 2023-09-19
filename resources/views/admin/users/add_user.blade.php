@extends('admin.layouts.app')
@section('content')
<!-- Page title -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-auto">
            <!-- Page pre-title -->
            <h2 class="page-title">
                Add New User
            </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ml-auto d-print-none">
            <a href="{{ url('admin/users') }}" class="btn btn-primary btn-sm d-sm-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1"></path></svg>
                Return
            </a>
        </div>
    </div>
</div>
<div class="row row-deck row-cards">
    <div class="col-lg-12">
        
        <div class="card">
        
            <form method="post" action="{{ url('admin/user/add') }}">
                <div class="card-body">
                    @csrf
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Name</label>
                        <div class="col">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" name="name">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Email</label>
                        <div class="col">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" name="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label for="password" class="form-label col-3 col-form-label">
                            {{ __('Password') }}
                        </label>
                        <div class="col">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label for="password-confirm" class="form-label col-3 col-form-label">
                            {{ __('Confirm Password') }}
                        </label>
                        <div class="col">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="hr-text">Other information</div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">User Role</label>
                        <div class="col">
                            @foreach($roles as $role)
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role[]" value="{{ $role->name }}" @if($role->name == 'User') checked @endif>
                                <span class="form-check-label">{{ $role->name }}</span>
                            </label>
                            @endforeach
                            
                            @error('role')
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
                                <input class="form-check-input" type="radio" name="status" value="1" checked>
                                <span class="form-check-label">Active</span>
                            </label>
                            
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" value="2">
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
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
        
    </div>
</div>
@endsection