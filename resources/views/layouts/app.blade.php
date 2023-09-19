<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ App\Settings::first()->dir }}">
    <head>
        
        @if(!App\Settings::first()->analytics == null)
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-{{ App\Settings::first()->analytics }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            
            gtag('config', 'UA-{{ App\Settings::first()->analytics }}');
        </script>
        @endif
        
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>{{ $title }}</title>
        <meta name="description" content="{{ $desc }}">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <meta name="msapplication-TileColor" content="#206bc4"/>
        <meta name="theme-color" content="#206bc4"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="mobile-web-app-capable" content="yes"/>
        <meta name="HandheldFriendly" content="True"/>
        <meta name="MobileOptimized" content="320"/>
        <meta name="robots" content="noindex,nofollow,noarchive"/>
        <link rel="icon" href="" type="image/x-icon"/>
        <link rel="shortcut icon" href="" type="image/x-icon"/>
        <!-- CSS files -->
        <link rel="stylesheet" href="{{ asset('dist/css/tabler.min.css') }}" />

        <meta property="og:url"                content="{{ \Request::fullUrl() }}"/>
        <meta property="og:type"               content="article" />
        <meta property="og:title"              content="{{ $title }}" />
        <meta property="og:description"        content="{{ $desc }}" />
        
    </head>
    <body class="antialiased theme-dark">
        <header class="navbar navbar-expand-md navbar-dark bg-cyan">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a href="{{ url('/') }}" class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pr-0 pr-md-3">
                    @if(!empty(App\Settings::first()->logo))
                    <img src="{{ url('dist/img//logo/'.App\Settings::first()->logo) }}" class="navbar-brand-image" alt="" title="{{ App\Settings::first()->website_name }}" data-toggle="tooltip" data-placement="bottom" title="{{ App\Settings::first()->website_name }}"/>
                    @else
                    {{ App\Settings::first()->website_name }}
                    @endif
                </a>
                <div class="navbar-nav flex-row order-md-last">
                    @if(Auth::check())
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-toggle="dropdown">
                            @if(Auth::user()->avatar == NULL)
                            <span class="avatar"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="7" r="4"></circle><path d="M5.5 21v-2a4 4 0 0 1 4 -4h5a4 4 0 0 1 4 4v2"></path></svg></span>
                            @else
                            <span class="avatar" style="background-image: url({{ url('dist/img/avatar/'.Auth::user()->avatar)}})"></span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ url('send') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2"></path><line x1="12" y1="10" x2="12" y2="16"></line><line x1="9" y1="13" x2="15" y2="13"></line></svg>
                                {{ __('app.text_11') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('@'.Auth::user()->name) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><rect x="3" y="4" width="18" height="16" rx="3"></rect><circle cx="9" cy="10" r="2"></circle><line x1="15" y1="8" x2="17" y2="8"></line><line x1="15" y1="12" x2="17" y2="12"></line><line x1="7" y1="16" x2="17" y2="16"></line></svg>
                                {{ __('app.text_1') }}
                            </a>
                            <a class="dropdown-item" href="{{ url('user/my-items') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M9 5H7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2V7a2 2 0 0 0 -2 -2h-2"></path><rect x="9" y="3" width="6" height="4" rx="2"></rect><line x1="9" y1="12" x2="9.01" y2="12"></line><line x1="13" y1="12" x2="15" y2="12"></line><line x1="9" y1="16" x2="9.01" y2="16"></line><line x1="13" y1="16" x2="15" y2="16"></line></svg>
                                {{ __('app.text_2') }}
                            </a>
                            <a class="dropdown-item" href="{{ url('user/my-favorites') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M12 20l-7 -7a4 4 0 0 1 6.5 -6a.9 .9 0 0 0 1 0a4 4 0 0 1 6.5 6l-7 7"></path></svg>
                                {{ __('app.text_3') }}
                            </a>
                            <a class="dropdown-item" href="{{ url('user/edit/') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                                {{ __('app.text_4') }}
                            </a>
                            @if(Auth::user()->hasRole('admin'))
                            <a class="dropdown-item strong" href="{{url('admin')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6-6a6 6 0 0 1 -8 -8l3.5 3.5"></path></svg>
                                {{__('app.text_5')}}
                            </a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path><path d="M7 12h14l-3 -3m0 6l3 -3"></path></svg>
                                {{ __('app.text_6') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    @else
                    <li class="nav-item {{ (request()->is('/login')) ? 'active' : '' }}">
                        <a data-toggle="tooltip" data-placement="left" title="{{ __('app.text_36') }}" class="nav-link" href="{{ url('/login') }}">
                            <span class="nav-link-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M18.9 7a8 8 0 0 1 1.1 5v1a6 6 0 0 0 .8 3"></path><path d="M8 11a4 4 0 0 1 8 0v1a10 10 0 0 0 2 6"></path><path d="M12 11v2a14 14 0 0 0 2.5 8"></path><path d="M8 15a18 18 0 0 0 1.8 6"></path><path d="M4.9 19a22 22 0 0 1 -.9 -7v-1a8 8 0 0 1 12 -6.95"></path></svg>
                            </span>
                        </a>
                    </li>

                    <li class="nav-item {{ (request()->is('/register')) ? 'active' : '' }}">
                        <a data-toggle="tooltip" data-placement="left" title="{{ __('app.text_37') }}" class="nav-link" href="{{ url('/register') }}">
                            <span class="nav-link-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="8.5" cy="7" r="4"></circle><path d="M2 21v-2a4 4 0 0 1 4 -4h5a4 4 0 0 1 4 4v2"></path><line x1="16" y1="11" x2="22" y2="11"></line><line x1="19" y1="8" x2="19" y2="14"></line></svg>
                            </span>
                        </a>
                    </li>
                    @endif
                </div>
                  
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                        <ul class="navbar-nav">
                            
                            <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/') }}">
                                    <span class="nav-link-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><polyline points="5 12 3 12 12 3 21 12 19 12"></polyline><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
                                        {{ __('app.text_8') }}
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#navbar-third" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span class="nav-link-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M9 4h3l2 2h5a2 2 0 0 1 2 2v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2"></path><path d="M17 17v2a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2h2"></path></svg>
                                        {{ __('app.text_9') }}
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    @php $categories = App\Categories::all() @endphp
                                    @forelse($categories as $cat)
                                    <li>
                                        <a class="dropdown-item" href="{{ url('category/'.$cat->slug) }}">
                                            {{ $cat->name }}
                                        </a>
                                    </li>
                                    @empty
                                    <li>
                                        {{ __('app.text_10') }}
                                    </li>
                                    @endforelse
                                    <div class="dropdown-divider"></div>
                                    @php $genders = App\Genders::all() @endphp
                                    @forelse($genders as $gender)
                                    <li>
                                        <a class="dropdown-item" href="{{ url('gender/'.$gender->gender_slug) }}">
                                            {{ $gender->gender_title }}
                                        </a>
                                    </li>
                                    @empty
                                    <li>
                                        {{ __('app.text_10') }}
                                    </li>
                                    @endforelse
                                </ul>
                            </li>
                        </ul>
                        
                        <div class="ml-md-auto pl-md-4 py-2 py-md-0 mr-md-4 order-first order-md-last flex-grow-1">
                            <form action="{{ route('search') }}" method="GET">
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
                                    </span>
                                    <input type="text" class="form-control form-control-dark" name="key" value="{{ old('key') }}" placeholder="{{ __('app.text_10') }}">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <div class="content">
            <div class="container-xl">
                
                @include('admin.layouts.message')
                @yield('content')
              
            </div>
        </div>
          
        <footer class="footer">
            <div class="container">
                <div class="row text-center align-items-center flex-row-reverse">
                    <div class="col-lg-auto ml-lg-auto">
                        <ul class="list-inline list-inline-dots mb-0">
                        @php
                        $pages = App\Page::where('status', 1)->limit(5)->get()
                        @endphp
                        @forelse($pages as $page)
                            <li class="list-inline-item">
                                <a href="{{ url('page/'.$page->slug) }}" class="link-secondary">
                                    {{$page->title}}
                                </a>
                            </li>
                        @empty
                        {{__('app.text_14')}}
                        @endforelse
                        </ul>
                    </div>

                    <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-muted">
                        Copyright © 2020 <a href="{{url('')}}" class="link-secondary">{{App\Settings::first()->website_name}}</a>
                    </div>
                </div>
            </div>
        </footer>
          
        <!-- Libs JS -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="{{ asset('dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Scripts -->
        <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>

        <script type="text/javascript">
        // Save Like Or Dislike
        $(document).on('click','#saveLikeDislike',function(){
            var _post=$(this).data('post');
            var _type=$(this).data('type');
            var vm=$(this);
            // Run Ajax
            $.ajax({
                url:"{{ url('save-likedislike') }}",
                type:"post",
                dataType:'json',
                data:{
                    post:_post,
                    type:_type,
                    _token:"{{ csrf_token() }}"
                },
                beforeSend:function(){
                    vm.addClass('disabled');
                },
                success:function(res){
                    if(res.bool==true){
                        vm.removeClass('disabled').addClass('active');
                        vm.removeAttr('id');
                        var _prevCount=$("."+_type+"-"+_post+"").text();
                        _prevCount++;
                        $("."+_type+"-"+_post+"").text(_prevCount);
                    } 
                    
                    if(res.bool==false){
                        vm.removeClass('active').addClass('disabled');
                        vm.removeAttr('id');
                        var _prevCount=$("."+_type+"-"+_post+"").text();
                        _prevCount--;
                        $("."+_type+"-"+_post+"").text(_prevCount);
                    }
                }   
            });
        });
        // End
            
        // Save Favorite
        $(document).on('click','#saveFavorite',function(){
            var _post=$(this).data('post');
            var vm=$(this);
            // Run Ajax
            $.ajax({
                url:"{{ url('save-favorite') }}",
                type:"post",
                dataType:'json',
                data:{
                    post:_post,
                    _token:"{{ csrf_token() }}"
                },
                beforeSend:function(){
                    vm.removeClass('text-orange').addClass('disabled');
                },
                success:function(res){
                    if(res.bool==true){
                        vm.removeClass('text-muted').addClass('text-orange');
                        vm.removeAttr('id');
                        
                        if(res.bool==false){
                            vm.removeClass('text-orange').addClass('text-muted');
                            vm.removeAttr('id');
                        }
                    }
                }   
            });
        });
        // End

        // Save Comment
        $(".save-comment").on('click',function(){
            var _comment=$(".comment").val();
            var _post=$(this).data('post');
            var vm=$(this);
            // Run Ajax
            $.ajax({
                url:"{{ url('save-comment') }}",
                type:"post",
                dataType:'json',
                data:{
                    comment:_comment,
                    post:_post,
                    _token:"{{ csrf_token() }}"
                },
                beforeSend:function(){
                    vm.text('Saving...').addClass('disabled');
                },
                success:function(res){
                    //var _html='<blockquote class="blockquote mb-4"><div class="float-left mr-3"><span class="avatar avatar-md"></span></div><div class="lh-sm"><small class="float-right text-muted">'+value.created_at+'</small><div class="text-muted strong"><a href="">You</a></div><div class="text-muted">'+_comment+'</div></div></blockquote>';
                    if(res.bool==true){
                        $(".comments").prepend(_html);
                        $(".comment").val('');
                        $(".comment-count").text($('blockquote').length);
                        $(".no-comments").hide();
                    }
                    vm.text('Save').removeClass('disabled');
                }   
            });
        });
        
        // Limit character
        var maxLength = {{ App\Settings::first()->max_chars_story }};
        $('textarea').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
            
        </script>
        
    </body>
</html>