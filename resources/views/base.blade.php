<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    {{-- Bootstrap core CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.dataTables.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/laravel-admin/laravel-admin.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.toast.min.css') }}"/>

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
            <div class="@if($fluid ?? false) container-fluid @else container @endif">
                <a class="navbar-brand" href="{{ url('/') }}" title="@lang('common.link_home')">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {{-- Left Side Of Navbar --}}
                    <ul class="navbar-nav mr-auto">
                        @include('layouts.partials.nav')
                    </ul>

                    {{-- Right Side Of Navbar --}}
                    <ul class="navbar-nav ml-auto">
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
                                            {{ __('Logout') }}
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
            <div class="@if($fluid ?? false) container-fluid @else container @endif">
                @yield('content')
            </div>
        </main>
    </div>

    @routes
    @include('layouts.partials.footer-scripts')
    @stack('footer-scripts')
</body>
</html>
