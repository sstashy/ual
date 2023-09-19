@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Profile</h3>
            </div>
            <form method="post" action="{{ url('user/edit/') }}" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-auto">
                          
                          @if($item->avatar == NULL)
                            <span class="avatar avatar-lg"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="7" r="4"></circle><path d="M5.5 21v-2a4 4 0 0 1 4 -4h5a4 4 0 0 1 4 4v2"></path></svg></span>
                          @else
                          <span class="avatar avatar-lg" style="background-image: url({{ url('dist/img/avatar/'.Auth::user()->avatar)}})">
                              <a href="{{ url('user/delete/avatar') }}" data-toggle="tooltip" data-placement="top" title="{{ __('app.text_35') }}">
                                  <span class="badge bg-danger">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><line x1="4" y1="7" x2="20" y2="7"></line><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg>
                                  </span>
                              </a>
                          </span>
                            @endif
                          
                      </div>
                      <div class="col">
                        <div class="mb-2">
                          <label class="form-label">Avatar</label>
                          
                            
                            <input type="file" name="avatar" class="form-control @error('logo') is-invalid @enderror">
                            
                            @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                      </div>
                    </div>
                    <div class="mb-2">
                      <label class="form-label">Bio</label>
                      <textarea class="form-control @error('bio') is-invalid @enderror" name="bio" rows="5">{{ $item->bio }}</textarea>
                        
                        @error('bio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    </div>
                    
                    
                    <div class="form-label mb-2">
                        <div class="hr-text"><label class="form-label text-center">
                            <span class="badge badge-pill bg-blue">{{ Carbon::parse(Auth::user()->birth)->diffInYears(Carbon::today()) }} {{ __('app.text_25') }}</span>
                        </label></div>
                        <input type="date" class="form-control form-control-lg @error('birth') is-invalid @enderror" value="{{ !empty(old('birth')) ? old('birth') : Auth::user()->birth }}" name="birth">

                        @error('birth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <div class="hr-text">{{ __('app.text_26') }}</div>
                        <div class="col">
                            <div class="form-selectgroup">
                                @foreach($genders as $gender)
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="gender" value="{{ $gender->id }}" class="form-selectgroup-input" {{ $gender->id == Auth::user()->gender ? 'checked' : '' }}>
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

                    <div class="hr-text">{{ __('app.text_27') }}</div>
                    
                      <div class="form-label mb-2">
                          <label class="form-label">Username</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ !empty(old('name')) ? old('name') : $item->name }}" name="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ !empty(old('email')) ? old('email') : $item->email }}" name="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                      
                    <div class="hr-text">{{ __('Change Password') }}</div>
                        
                        <div class="form-group mb-3">
                                <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" autocomplete="new-password" value="{{old('new_password')}}" placeholder="New Password">

                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>

                        <div class="form-group mb-3">
                                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="new_confirm_password" placeholder="Repeat New Password">
                        
                        </div>
                      
                    <div class="form-footer">
                      <button class="btn btn-primary btn-block">Update</button>
                    </div>
                </div>
        </form>
                    
              </div>
    </div>
    
   
</div>
@endsection