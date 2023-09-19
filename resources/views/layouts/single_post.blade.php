<div class="col">
    <div class="card">
        @if($item->image == null)
        <div class="card-header text-white bg-{{ App\Genders::find($item->gender)->gender_color }}">
            <h3 class="card-title">
                <a href="{{ url('item/'.$item->slug) }}" class="link-light">
                    {{ $item->title }}
                </a>
            </h3>
        </div>
        @else
        <div class="card-link">
            <div class="card-cover" style="background-image: url({{ url('dist/img/item/'.$item->image) }}); min-height:250px; width:100%;">
            </div>
        </div>
        @endif
        
        <div class="card-body">
            <h3 class="card-title">{{ App\Genders::find($item->gender)->gender_title }} - {{ $item->age }} years old</h3>
            <p class="text-white">{{ $item->story }}</p>
            
            <ul class="list-inline list-inline-dots mb-2">
                <li class="list-inline-item">
                    <small class="text-muted">{{ $item->views }} {{ __('app.text_38') }}</small>
                </li>
                <li class="list-inline-item">
                    <small class="text-muted">{{ Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans() }}</small>
                </li>
            </ul>
            
            <small class="text-muted">
                <!-- if there are votes for this post -->
                @if(App\LikeDisLike::where('item_id', $item->id)->count()>0) Voted by
                <!-- if there are, show them to me -->
                @foreach($votes as $vote)
                <a href="{{ url('@'.App\User::find($vote->user_id)->name) }}" class="strong">{{ App\User::find($vote->user_id)->name }}</a>
                @endforeach
                <!-- end foreach -->
                <!-- if the votes are greater than one, show me the rest -->
                @if(App\LikeDisLike::where('item_id', $item->id)->count()>1) and {{ App\LikeDisLike::where('item_id', $item->id)->count()-1 }} other users @endif
                <!-- endif -->
                @endif
            </small>
             
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
                    <a href="#" class="text-muted mr-3" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="6" r="3"></circle><circle cx="18" cy="18" r="3"></circle><line x1="8.7" y1="10.7" x2="15.3" y2="7.3"></line><line x1="8.7" y1="13.3" x2="15.3" y2="16.7"></line></svg>
                        {{__('app.text_17')}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="https://www.facebook.com/sharer/sharer.php?u={{url('/item/'.$item->slug)}}&picture={{ url('dist/img/item/'.$item->image) }}&text={{ Str::of($item->story)->words(12, '...') }}">Facebook</a>
                        <a class="dropdown-item" href="whatsapp://send?text={{url('/item/'.$item->slug)}}">Whatsapp</a>
                    </div>
                </div>
                
                <span data-toggle="tooltip" data-placement="top" title="Favorite" id="saveFavorite" data-post="{{ $item->id }}" class="@if(@App\Items::checkFav(Auth::id(), $item->id) == 1) text-orange @else text-white @endif">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z"></path></svg>
                </span>
                
            </div>
        </div>
        
    </div>
    
    
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">
                {{ __('app.text_29') }}
            </h3>
            <div class="ml-auto">
                <span class="comment-count float-right badge badge-pill bg-blue">
                    {{ count($item->comments) }}
                </span>
            </div>
        </div>
        
        <div class="card-body">
            <div class="add-comment mb-3" id="comments">
                <form method="POST" action="{{ url('save-comment') }}">
                    @csrf
                    <textarea class="form-control comment @error('comment') is-invalid @enderror" name="comment" placeholder="{{ __('app.text_7') }}" @if(!Auth::check()) disabled @endif>{{ old('comment') }}</textarea>
                    <input type="hidden" data-post="{{ $item->id }}" value="{{ $item->id }}" name="post" />

                    @error('comment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="mb-2">
                        😃 😄 😜 😡 😍 💩 😪 😱 😨 😂
                    </div>
                    <button type="submit" class="btn btn-secondary btn-pill mt-2 save-comment" @if(!Auth::check()) disabled @endif>
                        {{ __('app.text_18') }}
                    </button>
                </form>
            </div>
            <hr/>
            
            <div class="comments">
                @if(count($item->comments)>0)
                    @foreach($item->comments as $comment)
                    <blockquote class="blockquote mb-4">
                        <div class="float-left mr-3">
                            @if(App\User::find($comment->user_id)->avatar == NULL)
                            <span class="avatar avatar-md"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="7" r="4"></circle><path d="M5.5 21v-2a4 4 0 0 1 4 -4h5a4 4 0 0 1 4 4v2"></path></svg></span>
                          @else
                          <span class="avatar avatar-md" style="background-image: url({{ url('dist/img/avatar/'.App\User::find($comment->user_id)->avatar)}})">
                          </span>
                        @endif
                        </div>
                        <div class="lh-sm">
                            <small class="float-right text-muted">{{ $comment->created_at }}</small>
                            <div class="text-muted strong">
                                <a href="{{ url('@'.App\User::find($comment->user_id)->name) }}">{{ App\User::find($comment->user_id)->name }}</a>
                            </div>
                            <div class="text-muted">{{ $comment->comment }}</div>
                        </div>
                    </blockquote>
                    @endforeach
                @else
                <div class="empty no-comments">
                    <div class="empty-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="13" r="7"></circle><polyline points="12 10 12 13 14 13"></polyline><line x1="7" y1="4" x2="4.25" y2="6"></line><line x1="17" y1="4" x2="19.75" y2="6"></line></svg>
                    </div>
                    <p class="empty-title h3">{{ __('app.text_19') }}</p>
                    <p class="empty-subtitle text-muted">
                        {{ __('app.text_20') }}
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>