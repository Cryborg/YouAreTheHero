<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
    </head>
    <body>
        @yield('content')
    </body>
    <footer>
        <a href="{{ url('/') }}">@lang('common.footer_link_home')</a>
        <a href="{{ url('/stories') }}">@lang('common.footer_link_stories')</a>
    </footer>
</html>
