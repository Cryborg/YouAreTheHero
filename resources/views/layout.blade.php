<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
    </head>
    <body>
        @yield('body')
    </body>
    <footer>
        <a href="{{ url('/stories') }}">Stories</a>
    </footer>
</html>
