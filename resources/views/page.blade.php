@extends('layouts.app')
@section('content')
<div class="row">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-auto">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    {{ __('app.text_43') }}
                </div>
                <h2 class="page-title">
                    {{ $item->title }}
                </h2>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-body">
                {!! nl2br($item->body) !!}
                
                <div class="mt-4">
                    <span class="text-muted mr-2">{{ $item->views }} {{ __('app.text_38') }}</span>
                    
                    <a href="#" class="text-muted mr-3" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="6" r="3"></circle><circle cx="18" cy="18" r="3"></circle><line x1="8.7" y1="10.7" x2="15.3" y2="7.3"></line><line x1="8.7" y1="13.3" x2="15.3" y2="16.7"></line></svg>
                        {{__('app.text_17')}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="https://www.facebook.com/sharer/sharer.php?u={{url('/item/'.$item->slug)}}&picture={{ url('dist/img/item/'.$item->image) }}&text={{ Str::of($item->story)->words(12, '...') }}">Facebook</a>
                        <a class="dropdown-item" href="whatsapp://send?text={{url('/item/'.$item->slug)}}">Whatsapp</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
</div>
@endsection