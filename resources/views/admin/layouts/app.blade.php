<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ App\Settings::first()->dir }}">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>{{ $title }}</title>
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <meta name="msapplication-TileColor" content="#206bc4"/>
        <meta name="theme-color" content="#206bc4"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="mobile-web-app-capable" content="yes"/>
        <meta name="HandheldFriendly" content="True"/>
        <meta name="MobileOptimized" content="320"/>
        <meta name="robots" content="noindex,nofollow,noarchive"/>
        <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
        <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon"/>
        <!-- CSS files -->
        <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet"/>
    </head>
    <body class="antialiased">
        <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a href="{{ url('admin') }}" class="navbar-brand navbar-brand-autodark">
                    <img src="{{ asset('dist/img/logo-labnetwork.png') }}" alt="" class="navbar-brand-image">
                </a>
                <div class="navbar-nav flex-row d-lg-none">
                    @auth
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-toggle="dropdown">
                            <span class="avatar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="7" r="4"></circle><path d="M5.5 21v-2a4 4 0 0 1 4 -4h5a4 4 0 0 1 4 4v2"></path></svg>
                            </span>
                            <div class="d-none d-xl-block pl-2">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="mt-1 small text-muted">{{ Auth::user()->email }}</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ url('admin/user/edit/'.Auth::user()->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                                {{ __('admin.edit_account') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg> 
                                {{ __('admin.logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    @endauth
                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="navbar-nav pt-lg-3">
                        <li class="nav-item {{ (request()->is('admin')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('admin') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg></span>
                                <span class="nav-link-title">
                                    {{ __('admin.dashboard') }}
                                </span>
                            </a>
                        </li>
                        
                        <li class="nav-item {{ (request()->is('admin/users')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('admin/users') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="7" cy="5" r="2"></circle><path d="M5 22v-5l-1-1v-4a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4l-1 1v5"></path><circle cx="17" cy="5" r="2"></circle><path d="M15 22v-4h-2l2 -6a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1l2 6h-2v4"></path></svg></span>
                                <span class="nav-link-title">
                                    {{ __('admin.users') }}
                                </span>
                            </a>
                        </li>
                        
                        <li class="nav-item {{ (request()->is('admin/pages')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('admin/pages') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><polyline points="14 3 14 8 19 8"></polyline><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path><line x1="9" y1="9" x2="10" y2="9"></line><line x1="9" y1="13" x2="15" y2="13"></line><line x1="9" y1="17" x2="15" y2="17"></line></svg></span>
                                <span class="nav-link-title">
                                    {{ __('admin.pages') }}
                                </span>
                            </a>
                        </li>
                        
                        <li class="nav-item {{ (request()->is('admin/items')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('admin/items') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><rect x="5" y="3" width="14" height="18" rx="2"></rect><line x1="9" y1="7" x2="15" y2="7"></line><line x1="9" y1="11" x2="15" y2="11"></line><line x1="9" y1="15" x2="13" y2="15"></line></svg></span>
                                <span class="nav-link-title">
                                    Items
                                </span>
                            </a>
                        </li>
                        
                        <li class="nav-item {{ (request()->is('admin/comments')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('admin/comments') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4"></path><line x1="12" y1="11" x2="12" y2="11.01"></line><line x1="8" y1="11" x2="8" y2="11.01"></line><line x1="16" y1="11" x2="16" y2="11.01"></line></svg></span>
                                <span class="nav-link-title">
                                    Comments
                                </span>
                            </a>
                        </li>
                        
                        <li class="nav-item {{ (request()->is('admin/categories')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('admin/categories') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M9 4h3l2 2h5a2 2 0 0 1 2 2v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2"></path><path d="M17 17v2a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2h2"></path></svg></span>
                                <span class="nav-link-title">
                                    Categories
                                </span>
                            </a>
                        </li>
                        
                        <li class="nav-item {{ (request()->is('admin/genders')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('admin/genders') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="7" cy="5" r="2"></circle><path d="M5 22v-5l-1-1v-4a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4l-1 1v5"></path><circle cx="17" cy="5" r="2"></circle><path d="M15 22v-4h-2l2 -6a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1l2 6h-2v4"></path></svg></span>
                                <span class="nav-link-title">
                                    Genders
                                </span>
                            </a>
                        </li>
                         
                        <li class="nav-item {{ (request()->is('admin/advertisements')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('admin/advertisements') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><rect x="3" y="5" width="18" height="14" rx="2"></rect><path d="M7 15v-4a2 2 0 0 1 4 0v4"></path><line x1="7" y1="13" x2="11" y2="13"></line><path d="M17 9v6h-1.5a1.5 1.5 0 1 1 1.5 -1.5"></path></svg></span>
                                <span class="nav-link-title">
                                    Advertisement
                                </span>
                            </a>
                        </li>
                        
                        <li class="nav-item {{ (request()->is('admin/settings')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('admin/settings') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6-6a6 6 0 0 1 -8 -8l3.5 3.5"></path></svg></span>
                                <span class="nav-link-title">
                                    {{ __('admin.settings') }}
                                </span>
                            </a>
                        </li>
                        
                        <li class="nav-item bg-orange active">
                            <a class="nav-link" href="{{ url('/') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1"></path></svg></span>
                                <span class="nav-link-title strong">
                                    {{ __('Go to the site') }}
                                </span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </aside>
        
        <div class="page">
            <header class="navbar navbar-expand-md navbar-light d-none d-lg-flex">
                <div class="container-xl">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-nav flex-row order-md-last">
                        @auth
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-toggle="dropdown">
                                <span class="avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="7" r="4"></circle><path d="M5.5 21v-2a4 4 0 0 1 4 -4h5a4 4 0 0 1 4 4v2"></path></svg>
                                </span>
                                <div class="d-none d-xl-block pl-2">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="mt-1 small text-muted">{{ Auth::user()->email }}</div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ url('admin/user/edit/'.Auth::user()->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                                    {{ __('admin.edit_account') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg> {{ __('admin.logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        @endauth
                    </div>
                </div>
            </header>
            <div class="content">
                <div class="container-xl">
                    @include('admin.layouts.message')
                    @yield('content')
                </div>
                <footer class="footer footer-transparent">
                    <div class="container">
                        <div class="row text-center align-items-center flex-row-reverse">
                            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                                Copyright © 2020
                                <a href="https://codecanyon.net/user/labnetwork/portfolio" class="link-secondary">
                                    LabNetwork
                                </a>.
                                All rights reserved.
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- Libs JS -->
        <script src="{{ asset('dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('dist/libs/jquery/dist/jquery.slim.min.js') }}"></script>
        <!-- Tabler Core -->
        <script src="{{ asset('dist/js/tabler.min.js')}}"></script>
    </body>
</html>