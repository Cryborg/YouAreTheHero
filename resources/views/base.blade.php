<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <base href="{{ config('app.url') }}/">

    <title>@yield('title', trans('home.welcome'))</title>

    {{-- Bootstrap core CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/buttons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap-select/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.toast.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/summernote-bs4.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom-switch.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/icomoon.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dagred3.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/splide/dist/css/splide.min.css') }}">

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
        {{-- Upper navigation bar --}}
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand"  href="{{ url('/') }}">
                    <img src="{{ asset('img/minibot.jpg') }}" width="64" height="64" style="margin-top: -12px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMainMenu" aria-controls="navbarMainMenu" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarMainMenu">
                    {{-- Left Side Of Navbar --}}
                    <ul class="navbar-nav mr-auto">
                        @auth
                            @if (Auth::check() && Auth::user()->role !== 'temp')
                                @include('layouts.partials.nav')
                            @endif
                        @endauth
                    </ul>

                    <ul class="navbar-nav">
                        <img src="img/banner.png" height="50px">
                    </ul>

                    {{-- Right Side Of Navbar --}}
                    {{-- Discord --}}
                    <ul class="navbar-nav ml-auto mr-5">
                        <a href="https://discord.gg/zc9TePC" target="_blank" class="nav-link clickable text-white" style="width: 150px">
                            <img src="{{ asset('img/discord.png') }}" class="w-100 shadow">
                        </a>
                    </ul>

                    {{-- Help --}}
                    @auth()
                        @if (Auth::check() && Auth::user()->role !== 'temp')
                            <ul class="navbar-nav mr-5 shadow">
                                <li class="nav-item bg-success pl-2 pr-2">
                                    <a class="nav-link clickable text-white" data-target="#modalHelp" data-toggle="modal">
                                        <span class="icon-help text-white mr-2 font-biggest"></span>
                                        {{ trans('common.help') }}
                                    </a>
                                </li>
                            </ul>
                        @endif
                    @endauth

                    {{-- Languages / Translations --}}
                    <ul class="navbar-nav">
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

                                @can('isAdmin')
                                    <div role="separator" class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="{{ url('/translations') }}" target="_blank">
                                        {{ trans('auth.translations') }}
                                    </a>
                                @endcan
                            </div>
                        </li>
                    </ul>

                    {{-- Player profile --}}
                    <ul class="navbar-nav">
                        {{-- Authentication Links --}}
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ trans('auth.login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ trans('auth.register') }}</a>
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
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                                @if (Auth::check() && Auth::user()->role !== 'temp')
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->username }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('user.profile') }}">
                                                {{ trans('user.profile_title') }}
                                            </a>
                                            <div role="separator" class="dropdown-divider"></div>
                                            <a class="dropdown-item" href=""
                                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                {{ trans('auth.logout') }}
                                            </a>
                                        </div>
                                    </li>
                                @else
                                    <a class="dropdown-item" href=""
                                        onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                        {{ trans('auth.logout') }}
                                    </a>
                                @endif
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        {{--  --}}
        <main class="pt-5">
            <div class="@if($fluid ?? true) container-fluid @else container @endif pt-5">
                @yield('content')
            </div>
        </main>

        @auth()
            <!-- Modal help -->
            @include('page.partials.modal_model', [
                'template' => 'layouts.partials.modal_help',
                'context' => 'help',
                'title' => trans('common.help_modal_title'),
                'icon' => 'icon-help',
                'big' => true,
                'data' => [
                    'id' => 'Help',
                ]
            ])
        @endauth
    </div>

    @routes
    @include('layouts.partials.footer-scripts')
    @stack('footer-scripts')
</body>
</html>
