@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        
        <h2 class="text-muted text-center mb-4">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z"></path></svg>
            </div>
            {{ __('app.text_3') }}
        </h2>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ Auth::user()->name }}'s {{ __('app.text_34') }}</h3>
            </div>
            
            <div class="list list-row">
                
                @forelse($favorites as $favorite)
                
                @php
                $items = App\Items::where('id', $favorite->item_id)
                ->where('status', 1)
                ->orderByDesc('id')
                ->paginate(20);
                @endphp
                
                @foreach($items as $item)
                <div class="list-item">
                    <div class="text-truncate">
                        <a href="{{ url('item/'.$item->slug) }}" class="text-white d-block">
                            {{ $item->title }}
                        </a>
                        <small class="d-block text-muted text-truncate mt-n1">
                            Bookmarked on: {{ $favorite->created_at }}
                        </small>
                    </div>
                    
                    <div class="list-item-actions">
                        <span data-toggle="tooltip" data-placement="top" title="Favorite" id="saveFavorite" data-post="{{ $item->id }}" class="@if(@App\Items::checkFav(Auth::id(), $item->id) == 1) text-orange @else text-white @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z"></path></svg>
                        </span>
                    </div>
                    
                </div>
                @endforeach
                
                {{ $items->links() }}
                
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
    </div>
</div>
@endsection