@extends('admin.layouts.app')
@section('content')
<!-- Page title -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-auto">
            <!-- Page pre-title -->
            <h2 class="page-title">
                Edit User
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
        
            <form method="post" action="{{ url('admin/user/edit/'.$item->id) }}">
                <div class="card-body">
                    @csrf
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Name</label>
                        <div class="col">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ !empty(old('name')) ? old('name') : $item->name }}" name="name">

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
                            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ !empty(old('email')) ? old('email') : $item->email }}" name="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">User Role</label>
                        <div class="col">
                            @foreach($roles as $role)
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role[]" value="{{ $role->name }}"
                                       {{ $item->roles->first()->id == $role->id ? 'checked' : '' }}>
                                <span class="form-check-label">{{ $role->name }}</span>
                            </label>
                            @endforeach
                            
                            @error('status')
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
                    
                    <div class="hr-text">{{ __('Change Password') }}</div>
                    
                    <div class="form-group mb-3 row">
                        <label for="password" class="form-label col-3 col-form-label">
                            {{ __('New Password') }}
                        </label>
                        <div class="col">
                            <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" autocomplete="new-password" value="{{old('new_password')}}">

                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label for="new_confirm_password" class="form-label col-3 col-form-label">
                            {{ __('Confirm New Password') }}
                        </label>
                        <div class="col">
                            <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="new_confirm_password">
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