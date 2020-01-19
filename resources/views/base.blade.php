<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <base href="{{ config('app.url') }}/">

    <title>@yield('title')</title>

    {{-- Bootstrap core CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap-select/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.dataTables.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/laravel-admin.min.css') }}"/>    {{-- FIXME: overkill, remove this and fix the navbar--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.toast.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/summernote-bs4.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/input_number.css') }}"/>

    {{-- Scripts --}}
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

    {{-- Fonts --}}
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Styles --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('head')
</head>
<body>
    @include('flash::message')
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="@if($fluid ?? true) container-fluid @else container @endif">
                <a class="navbar-brand" href="{{ url('/') }}" title="@lang('common.link_home')">
                    <img src="{{ asset('img/minibot.jpg') }}" width="64" height="64" style="margin-top: -12px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {{-- Left Side Of Navbar --}}
                    <ul class="navbar-nav mr-auto">
                        @auth
                            @include('layouts.partials.nav')
                        @endauth
                    </ul>

                    {{-- Right Side Of Navbar --}}
                    @if (Auth::id() === 1)
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" id="navbarDropdownFlag" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <img width="32" height="32" alt="{{ session('locale') }}"
                                        src="{!! asset('img/flags/' . session('locale') . '.png') !!}"/>
                                </a>
                                <div id="flags" class="dropdown-menu" aria-labelledby="navbarDropdownFlag">
                                    @foreach(config('app.languages') as $locale)
                                        @if($locale != session('locale'))
                                            <a class="dropdown-item" href="{{ route('language', $locale) }}">
                                                <img width="32" height="32" alt="{{ session('locale') }}"
                                                    src="{!! asset('img/flags/' . $locale . '.png') !!}"/>
                                            </a>
                                        @endif
                                    @endforeach

                                    <a class="dropdown-item" href="{{ url('/translations') }}" target="_blank">
                                        {{ trans('auth.translations') }}
                                    </a>
                                </div>
                            </li>
                        </ul>
                    @endif
                    <ul class="navbar-nav">
                        {{-- Authentication Links --}}
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            {{--
                            Story mode
                            Shows the menu for the character
                            --}}
                            @if (\Request::is('story.play'))
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ $character->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('stories.list') }}">
                                            {{ __('play.exit_story') }}
                                        </a>
                                    </div>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->username }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ trans('auth.logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="@if($fluid ?? true) container-fluid @else container @endif">
                @yield('content')
            </div>
        </main>
    </div>

    @routes
    @include('layouts.partials.footer-scripts')
    @stack('footer-scripts')
</body>
</html>
