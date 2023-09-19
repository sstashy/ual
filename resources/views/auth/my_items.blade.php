@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        
        <h2 class="text-muted text-center mb-4">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><rect x="3" y="4" width="18" height="4" rx="2"></rect><path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10"></path><line x1="10" y1="12" x2="14" y2="12"></line></svg>
            </div>
            {{ __('app.text_2') }}
        </h2>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ Auth::user()->name }}'s {{ __('app.text_33') }}</h3>
            </div>
            
            <div class="list list-row">
                
                @forelse($items as $item)
                <div class="list-item">
                    <div>
                        @if($item->status == 1)
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" data-toggle="tooltip" data-placement="top" title="{{__('app.text_39')}}"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M5 12l5 5l10 -10"></path></svg>
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" data-toggle="tooltip" data-placement="top" title="{{__('app.text_40')}}"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M5 12l5 5l10 -10"></path></svg>
                        @endif
                    </div>
                    
                    <div class="text-truncate">
                        <a href="{{ url('item/'.$item->slug) }}" class="text-white d-block">
                            {{ $item->title }}
                        </a>
                        <small class="d-block text-muted text-truncate mt-n1">
                            {{ $item->created_at }}
                        </small>
                    </div>
                    
                    <div class="list-item-actions">
                        <a href="{{ url('user/delete/item/'.$item->id) }}" class="ml-2" data-toggle="tooltip" data-placement="top" title="{{__('app.text_42')}}" onclick="return confirm('This action is final, are you sure?');" >
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><line x1="4" y1="7" x2="20" y2="7"></line><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg>
                        </a>
                    </div>
                    
                </div>
                @empty
                <div class="empty mt-4">
                    <div class="empty-icon">
                        <div class="spinner-grow" role="status"></div>
                    </div>
                    <p class="empty-title h3">{{__('app.text_13')}}</p>
                </div>
                @endforelse
            </div>

            
        </div>
        
        {{ $items->onEachSide(1)->links() }}
        
    </div>
</div>
@endsection