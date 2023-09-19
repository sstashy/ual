<div class="card-columns">
@forelse($items as $item)
    
    @if(!App\Settings::first()->adv_1 == NULL)
        @if($loop->first)
            @if(App\Advertisements::find(App\Settings::first()->adv_1) == true)
                <div class="card card-lg">
                    <div class="card-body text-center">
                        <p>{{ App\Advertisements::find(App\Settings::first()->adv_1)->adv }}</p>
                    </div>
                </div>
            @endif 
        @endif
    @endif

    @if(!App\Settings::first()->adv_2 == NULL)
        @if($loop->last)
            @if(App\Advertisements::find(App\Settings::first()->adv_2) == true)
                <div class="card card-lg">
                    <div class="card-body text-center">
                        <p>{{ App\Advertisements::find(App\Settings::first()->adv_2)->adv }}</p>
                    </div>
                </div>
            @endif 
        @endif
    @endif
    
    <div class="card">
        @if($item->image == null)
        <div class="card-header text-white bg-{{ App\Genders::find($item->gender)->gender_color }}">
            <h3 class="card-title">
                <a href="{{ url('item/'.$item->slug) }}" class="link-light">
                    {{ Str::limit($item->title, 22, '...') }}
                </a>
            </h3>
            <div class="ml-auto">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{url('/item/'.$item->slug)}}&picture={{ url('dist/img/item/'.$item->image) }}&text={{ Str::of($item->story)->words(12, '...') }}" target="_blank" class="text-white"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="icon" fill="currentColor"><path d="M22.676 0H1.324C.593 0 0 .593 0 1.324v21.352C0 23.408.593 24 1.324 24h11.494v-9.294H9.689v-3.621h3.129V8.41c0-3.099 1.894-4.785 4.659-4.785 1.325 0 2.464.097 2.796.141v3.24h-1.921c-1.5 0-1.792.721-1.792 1.771v2.311h3.584l-.465 3.63H16.56V24h6.115c.733 0 1.325-.592 1.325-1.324V1.324C24 .593 23.408 0 22.676 0"></path></svg></a> 
                    
                <a href="whatsapp://send?text={{url('/item/'.$item->slug)}}" target="_blank" class="text-white ml-2"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="icon" fill="currentColor"><path d="M17.498 14.382c-.301-.15-1.767-.867-2.04-.966-.273-.101-.473-.15-.673.15-.197.295-.771.964-.944 1.162-.175.195-.349.21-.646.075-.3-.15-1.263-.465-2.403-1.485-.888-.795-1.484-1.77-1.66-2.07-.174-.3-.019-.465.13-.615.136-.135.301-.345.451-.523.146-.181.194-.301.297-.496.1-.21.049-.375-.025-.524-.075-.15-.672-1.62-.922-2.206-.24-.584-.487-.51-.672-.51-.172-.015-.371-.015-.571-.015-.2 0-.523.074-.797.359-.273.3-1.045 1.02-1.045 2.475s1.07 2.865 1.219 3.075c.149.195 2.105 3.195 5.1 4.485.714.3 1.27.48 1.704.629.714.227 1.365.195 1.88.121.574-.091 1.767-.721 2.016-1.426.255-.705.255-1.29.18-1.425-.074-.135-.27-.21-.57-.345m-5.446 7.443h-.016c-1.77 0-3.524-.48-5.055-1.38l-.36-.214-3.75.975 1.005-3.645-.239-.375a9.869 9.869 0 0 1-1.516-5.26c0-5.445 4.455-9.885 9.942-9.885a9.865 9.865 0 0 1 7.021 2.91 9.788 9.788 0 0 1 2.909 6.99c-.004 5.444-4.46 9.885-9.935 9.885M20.52 3.449C18.24 1.245 15.24 0 12.045 0 5.463 0 .104 5.334.101 11.893c0 2.096.549 4.14 1.595 5.945L0 24l6.335-1.652a12.062 12.062 0 0 0 5.71 1.447h.006c6.585 0 11.946-5.336 11.949-11.896 0-3.176-1.24-6.165-3.495-8.411"></path></svg></a>
            </div>
        </div>
        @else
        <a class="card-link" href="{{ url('item/'.$item->slug) }}">
            <div class="card-cover" style="background-image: url({{ url('dist/img/item/'.$item->image) }}); min-height:250px; width:100%;">
                <h3 class="strong">
                    {{ Str::limit($item->title, 22, '...') }}
                </h3>
            </div>
        </a>
        @endif

        <div class="card-body">
            <h3 class="card-title">{{ App\Genders::find($item->gender)->gender_title }} - {{ $item->age }} years old</h3>
            <p>{{ Str::limit($item->story, 300, '...') }}</p>
            <ul class="list-inline list-inline-dots mb-0">
                <li class="list-inline-item">
                    <small class="text-muted">{{ $item->views }} {{ __('app.text_38') }}</small>
                </li>
                <li class="list-inline-item">
                    <small class="text-muted">{{ Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans() }}</small>
                </li>
            </ul>
        </div>
        
        <div class="card-footer">
            <div class="d-flex">

                <span data-toggle="tooltip" data-placement="top" title="Likes" id="saveLikeDislike" data-type="like" data-post="{{ $item->id}}" class="btn btn-outline-success btn-sm @if(@App\Items::checkLike(Auth::id(), $item->id) == 1) active @endif">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="8" y2="12"></line><line x1="12" y1="8" x2="12" y2="16"></line><line x1="16" y1="12" x2="12" y2="8"></line></svg>
                    <span class="like-{{$item->id}}">{{ $item->likes() }}</span>
                </span>
                
                <span data-toggle="tooltip" data-placement="top" title="Disikes" id="saveLikeDislike" data-type="dislike" data-post="{{ $item->id}}" class="ml-2 btn btn-outline-danger btn-sm @if(@App\Items::checkDislike(Auth::id(), $item->id) == 1) active @endif">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="12" r="9"></circle><line x1="8" y1="12" x2="12" y2="16"></line><line x1="12" y1="8" x2="12" y2="16"></line><line x1="16" y1="12" x2="12" y2="16"></line></svg>
                    <span class="dislike-{{$item->id}}">{{ $item->dislikes() }}</span>
                </span>
        
                <div class="ml-auto">
                    
                    <a href="{{ url('item/'.$item->slug.'#comments') }}" class="mr-3 text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1"></path><line x1="12" y1="12" x2="12" y2="12.01"></line><line x1="8" y1="12" x2="8" y2="12.01"></line><line x1="16" y1="12" x2="16" y2="12.01"></line></svg>
                        {{ count($item->comments) }}
                    </a>
                    
                    <span data-toggle="tooltip" data-placement="top" title="Favorite" id="saveFavorite" data-post="{{ $item->id }}" class="@if(@App\Items::checkFav(Auth::id(), $item->id) == 1) text-orange @else text-muted @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z"></path></svg>
                    </span>

                </div>
            </div>
        </div>
    </div>
@empty
</div>
<div class="empty mt-4">
    <div class="empty-icon">
        <div class="spinner-grow" role="status"></div>
    </div>
    <p class="empty-title h3">{{__('app.text_13')}}</p>
    <p class="empty-subtitle text-muted">
        {{__('app.text_14')}}
    </p>
</div>
@endforelse 

{{ $items->onEachSide(1)->links() }}