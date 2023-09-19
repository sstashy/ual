<div class="col-lg-3 mb-4">
    
    <a href="{{ url('send') }}" class="btn btn-secondary btn-lg btn-block mb-4">
        {{ __('app.text_11') }}
    </a>

    <div class="card">
        <div class="card-body">
            <div class="subheader mb-2">{{ __('app.text_9') }}</div>
            <div class="list-group list-group-transparent mb-3">
                @php $categories = App\Categories::all() @endphp
                @foreach($categories as $cat)
                <a class="list-group-item list-group-item-action d-flex align-items-center {{ (request()->is('category/'.$cat->slug)) ? 'active' : '' }}" href="{{ url('category/'.$cat->slug) }}">
                    {{ $cat->name }}
                    <span class="badge badge-pill bg-blue ml-auto">
                        {{ App\Items::where('categories', $cat->id)->where('status', 1)->count() }}
                    </span>
                </a>
                @endforeach
            </div>
            
            <div class="hr-text"></div>
            
            <div class="subheader mb-2">{{ __('app.text_26') }}</div>
            <div class="list-group list-group-transparent mb-3">
                @php $genders = App\Genders::all() @endphp
                @foreach($genders as $gender)
                <a class="list-group-item list-group-item-action d-flex align-items-center {{ (request()->is('gender/'.$gender->gender_slug)) ? 'active' : '' }}" href="{{ url('gender/'.$gender->gender_slug) }}">
                    {{ $gender->gender_title }}
                    <span class="badge badge-pill bg-blue ml-auto">
                        {{ App\Items::where('gender', $gender->id)->where('status', 1)->count() }}
                    </span>
                </a>
                @endforeach
            </div>
            
        </div>
    </div>
    
    @if(!App\Settings::first()->adv_1 == NULL)
        @if(App\Advertisements::find(App\Settings::first()->adv_1) == true)
            <div class="card card-lg">
                <div class="card-body text-center">
                    <p>{{ App\Advertisements::find(App\Settings::first()->adv_1)->adv }}</p>
                </div>
            </div>
        @endif 
    @endif
</div>