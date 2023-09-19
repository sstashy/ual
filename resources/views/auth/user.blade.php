@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-{{ App\Genders::find($user->gender)->gender_color }}">
                <h3 class="card-title">{{ $user->name }}</h3>
            </div>
            
            <div class="card-body text-center">
                
                <div class="mb-3">
                    @if($user->avatar == NULL)
                    <span class="avatar avatar-xl"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="7" r="4"></circle><path d="M5.5 21v-2a4 4 0 0 1 4 -4h5a4 4 0 0 1 4 4v2"></path></svg></span>
                    @else
                    <span class="avatar avatar-xl" style="background-image: url({{ url('dist/img/avatar/'.$user->avatar) }})"></span>
                    @endif
                </div>
                
                @if(empty($user->bio))
                {{ __('app.text_28') }}
                @else
                {{ $user->bio }}
                @endif
                
            </div>
            
        </div>
        
        <div class="row row-cards row-deck">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h1 m-0">{{ App\Comments::where('user_id', $user->id)->where('status', 1)->count() }}</div>
                        <div class="text-muted">{{ __('app.text_29') }}</div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h1 m-0">{{ App\Items::where('user_id', $user->id)->where('status', 1)->count() }}</div>
                        <div class="text-muted">{{ __('app.text_30') }}</div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h1 m-0">{{ App\LikeDislike::where('user_id', $user->id)->count() }}</div>
                        <div class="text-muted">{{ __('app.text_31') }}</div>
                    </div>
                </div>
            </div>
            
        </div>
            
        <small class="text-muted">
            {{ __('app.text_32') }} {{ Carbon::createFromTimeStamp(strtotime($user->created_at))->diffForHumans() }}
        </small>
        
    </div>
</div>
@endsection